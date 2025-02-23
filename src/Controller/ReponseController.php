<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Entity\Reclamation;
use App\Form\ReponseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/reponse')]
#[IsGranted('ROLE_ADMIN')]
class ReponseController extends AbstractController
{
    #[Route('/reclamation/{id}/repondre', name: 'app_reponse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Reclamation $reclamation): Response
    {
        // Vérifier si la réclamation a déjà une réponse
        if ($reclamation->getReponse() !== null) {
            $this->addFlash('warning', 'Cette réclamation a déjà reçu une réponse.');
            return $this->redirectToRoute('app_reclamation_show', ['id' => $reclamation->getId()]);
        }

        $reponse = new Reponse();
        $reponse->setDate(new \DateTime());
        
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reponse);
            $reclamation->setReponse($reponse);
            $entityManager->flush();

            $this->addFlash('success', 'La réponse a été envoyée avec succès.');
            return $this->redirectToRoute('app_reclamation_show', ['id' => $reclamation->getId()]);
        }

        return $this->render('reponse/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reponse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'La réponse a été modifiée avec succès.');
            return $this->redirectToRoute('app_reclamation_index');
        }

        return $this->render('reponse/edit.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_reponse_delete', methods: ['POST'])]
    public function delete(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponse->getId(), $request->request->get('_token'))) {
            // Récupérer la réclamation associée avant de supprimer la réponse
            $reclamation = $entityManager->getRepository(Reclamation::class)->findOneBy(['reponse' => $reponse]);
            if ($reclamation) {
                $reclamation->setReponse(null);
            }
            
            $entityManager->remove($reponse);
            $entityManager->flush();
            
            $this->addFlash('success', 'La réponse a été supprimée avec succès.');
        }

        return $this->redirectToRoute('app_reclamation_index');
    }
}
