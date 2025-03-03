<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use App\Service\ContentFilterService;
use App\Service\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/reclamation')]
final class ReclamationController extends AbstractController
{
    private $emailService;
    private $contentFilter;

    public function __construct(EmailService $emailService, ContentFilterService $contentFilter)
    {
        $this->emailService = $emailService;
        $this->contentFilter = $contentFilter;
    }

    #[Route('/search', name: 'app_reclamation_search', methods: ['GET'])]
    public function search(Request $request, ReclamationRepository $reclamationRepository): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }

        try {
            $query = $request->query->get('q');
            
            // Si pas de query, retourner toutes les réclamations
            if (empty($query)) {
                $reclamations = $reclamationRepository->findBy([], ['date' => 'DESC']);
            } else {
                $reclamations = $reclamationRepository->findBySearch($query);
            }
            
            // Log pour le débogage
            error_log(sprintf(
                "Recherche - Query: %s, Nombre de résultats: %d",
                $query ?? 'vide',
                count($reclamations)
            ));

            return $this->render('reclamation/_table_content.html.twig', [
                'reclamations' => $reclamations
            ]);
        } catch (\Exception $e) {
            error_log("Erreur dans la recherche: " . $e->getMessage());
            
            // En cas d'erreur, essayer de retourner toutes les réclamations
            try {
                $reclamations = $reclamationRepository->findBy([], ['date' => 'DESC']);
                return $this->render('reclamation/_table_content.html.twig', [
                    'reclamations' => $reclamations
                ]);
            } catch (\Exception $e2) {
                if ($this->getParameter('kernel.debug')) {
                    throw $e2;
                }
                return new Response('Une erreur est survenue lors de la recherche.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    #[Route('/{id<\d+>}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        if (!$this->isGranted('ROLE_ADMIN') && $reclamation->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous n\'avez pas accès à cette réclamation.');
        }

        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id<\d+>}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        if ($reclamation->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas modifier cette réclamation.');
        }

        if ($reclamation->getReponse() !== null) {
            $this->addFlash('warning', 'Vous ne pouvez pas modifier une réclamation qui a déjà reçu une réponse.');
            return $this->redirectToRoute('app_reclamation_show', ['id' => $reclamation->getId()]);
        }

        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Analyser le contenu modifié
            $analysis = $this->contentFilter->analyzeContent($reclamation->getReclamation());
            
            // Si le contenu est inapproprié et que l'utilisateur n'est pas admin
            if ($analysis['is_inappropriate'] && !$this->isGranted('ROLE_ADMIN')) {
                $this->addFlash('error', 'Votre réclamation contient des termes inappropriés. Veuillez la reformuler.');
                
                $suggestions = $this->contentFilter->suggestImprovements($reclamation->getReclamation());
                foreach ($suggestions['suggestions'] as $suggestion) {
                    $this->addFlash('warning', "Suggestion : {$suggestion['suggestion']}");
                }
                
                return $this->render('reclamation/edit.html.twig', [
                    'reclamation' => $reclamation,
                    'form' => $form,
                ]);
            }

            try {
                $entityManager->flush();

                $this->addFlash('success', 'Votre réclamation a été modifiée avec succès.');
                return $this->redirectToRoute('app_reclamation_index');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de la modification de la réclamation.');
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        if ($reclamation->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer cette réclamation.');
        }

        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            try {
                $entityManager->remove($reclamation);
                $entityManager->flush();
                $this->addFlash('success', 'La réclamation a été supprimée avec succès.');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de la suppression de la réclamation.');
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->redirectToRoute('app_reclamation_index');
    }

    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $reclamations = $this->isGranted('ROLE_ADMIN') 
            ? $reclamationRepository->findAll()
            : $reclamationRepository->findBy(['user' => $user]);

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Analyser le contenu de la réclamation
            $analysis = $this->contentFilter->analyzeContent($reclamation->getReclamation());
            
            // Si le contenu est inapproprié et que l'utilisateur n'est pas admin
            if ($analysis['is_inappropriate'] && !$this->isGranted('ROLE_ADMIN')) {
                $this->addFlash('error', 'Votre réclamation contient des termes inappropriés. Veuillez la reformuler.');
                
                // Ajouter des suggestions spécifiques
                $suggestions = $this->contentFilter->suggestImprovements($reclamation->getReclamation());
                foreach ($suggestions['suggestions'] as $suggestion) {
                    $this->addFlash('warning', "Suggestion : {$suggestion['suggestion']}");
                }
                
                return $this->render('reclamation/new.html.twig', [
                    'reclamation' => $reclamation,
                    'form' => $form,
                ]);
            }

            // Si l'utilisateur est admin ou si le contenu est approprié
            $reclamation->setUser($user);
            $reclamation->setDate(new \DateTime());
            
            $entityManager->persist($reclamation);
            $entityManager->flush();

            $this->emailService->sendReclamationConfirmation(
                $user->getEmail(),
                $reclamation->getType()
            );

            $this->addFlash('success', 'Votre réclamation a été envoyée avec succès.');
            return $this->redirectToRoute('app_reclamation_index');
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/ajax-search', name: 'app_reclamation_ajax_search', methods: ['GET'])]
    public function ajaxSearch(Request $request, ReclamationRepository $reclamationRepository): JsonResponse
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return new JsonResponse(['error' => 'Accès refusé'], 403);
        }

        $search = $request->query->get('q', '');
        
        $reclamations = $reclamationRepository->findBySearch($search);
        
        $data = [];
        foreach ($reclamations as $reclamation) {
            $data[] = [
                'id' => $reclamation->getId(),
                'type' => $reclamation->getType(),
                'date' => $reclamation->getDate() ? $reclamation->getDate()->format('Y-m-d H:i:s') : '',
                'reclamation' => $reclamation->getReclamation(),
                'user' => $reclamation->getUser() ? $reclamation->getUser()->getEmail() : '',
                'actions' => $this->renderView('reclamation/_actions.html.twig', [
                    'reclamation' => $reclamation
                ])
            ];
        }
        
        return new JsonResponse($data);
    }
}
