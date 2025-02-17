<?php

namespace App\Controller;

use App\Entity\Tentative;
use App\Entity\User;
use App\Entity\Exercice;
use App\Service\ExerciceEvaluator;
use App\Repository\TentativeRepository;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/tentative')]
class TentativeController extends AbstractController
{
    #[Route('/exercice/{id}/submit', name: 'app_tentative_submit', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function submit(
        Request $request, 
        EntityManagerInterface $em,
        ExerciceRepository $exerciceRepository,
        ExerciceEvaluator $evaluator,
        int $id
    ): Response {
        $exercice = $exerciceRepository->find($id);
        
        if (!$exercice) {
            throw $this->createNotFoundException('Exercice non trouvé');
        }
        
        /** @var User $user */
        $user = $this->getUser();
        
        // Récupérer la réponse
        $reponse = $request->request->get('reponse');
        
        // Évaluer la réponse
        $evaluation = $evaluator->evaluate($reponse, $exercice);
        
        // Créer nouvelle tentative
        $tentative = new Tentative();
        $tentative->setUser($user);
        $tentative->setExercice($exercice);
        $tentative->setReponse($reponse);
        $tentative->setScore($evaluation['score']);
        $tentative->setStatue($evaluation['status']);
        $tentative->setDate(new \DateTime());
        
        $em->persist($tentative);
        $em->flush();
        
        // Rediriger vers la page des résultats avec le feedback
        $this->addFlash('evaluation_feedback', $evaluation['feedback']);
        
        return $this->redirectToRoute('app_tentative_resultat', [
            'id' => $tentative->getId()
        ]);
    }

    #[Route('/resultat/{id}', name: 'app_tentative_resultat', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function resultat(Tentative $tentative): Response
    {
        // Vérifier que l'utilisateur actuel est bien l'auteur de la tentative
        if ($tentative->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous n\'avez pas accès à cette tentative.');
        }
        
        return $this->render('tentative/resultat.html.twig', [
            'tentative' => $tentative,
        ]);
    }

    #[Route('/mes-tentatives', name: 'app_mes_tentatives', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function mesTentatives(TentativeRepository $tentativeRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        
        $tentatives = $tentativeRepository->findBy(
            ['user' => $user],
            ['date' => 'DESC']
        );
        
        return $this->render('tentative/mes_tentatives.html.twig', [
            'tentatives' => $tentatives
        ]);
    }

    #[Route('/exercice/{id}/tentatives', name: 'app_exercice_tentatives', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function tentativesParExercice(
        int $id,
        ExerciceRepository $exerciceRepository,
        TentativeRepository $tentativeRepository
    ): Response {
        $exercice = $exerciceRepository->find($id);
        
        if (!$exercice) {
            throw $this->createNotFoundException('Exercice non trouvé');
        }
        
        /** @var User $user */
        $user = $this->getUser();
        
        $tentatives = $tentativeRepository->findBy(
            ['user' => $user, 'exercice' => $exercice],
            ['date' => 'DESC']
        );
        
        return $this->render('tentative/exercice_tentatives.html.twig', [
            'tentatives' => $tentatives,
            'exercice' => $exercice
        ]);
    }
}
