<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/reclamation')]
final class ReclamationController extends AbstractController
{
    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        $user = $this->getUser();
        
        // Vérification de base pour tous les utilisateurs
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        try {
            $reclamations = !$this->isGranted('ROLE_ADMIN') 
                ? $reclamationRepository->findBy(['user' => $user])
                : $reclamationRepository->findAll();

            return $this->render('reclamation/index.html.twig', [
                'reclamations' => $reclamations,
            ]);
        } catch (\Exception $e) {
            // Log l'erreur et affiche un message utilisateur
            $this->addFlash('error', 'Une erreur est survenue lors du chargement des réclamations.');
            return $this->redirectToRoute('app_home');
        }
    }

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        // Vérification de base pour tous les utilisateurs
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $reclamation = new Reclamation();
        $reclamation->setDate(new \DateTime());
        $reclamation->setUser($user);
        
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->persist($reclamation);
                $entityManager->flush();

                $this->addFlash('success', 'Votre réclamation a été envoyée avec succès.');
                return $this->redirectToRoute('app_reclamation_index');
            } catch (\Exception $e) {
                // Log l'erreur et affiche un message utilisateur
                $this->addFlash('error', 'Une erreur est survenue lors de l\'envoi de la réclamation.');
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        $user = $this->getUser();
        
        // Vérification de base pour tous les utilisateurs
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier que l'utilisateur est soit l'admin soit le propriétaire de la réclamation
        if (!$this->isGranted('ROLE_ADMIN') && $reclamation->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous n\'avez pas accès à cette réclamation.');
        }

        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        // Vérification de base pour tous les utilisateurs
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier que l'utilisateur est le propriétaire de la réclamation
        if ($reclamation->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas modifier cette réclamation.');
        }

        // Si la réclamation a déjà une réponse, empêcher la modification
        if ($reclamation->getReponse() !== null) {
            $this->addFlash('warning', 'Vous ne pouvez pas modifier une réclamation qui a déjà reçu une réponse.');
            return $this->redirectToRoute('app_reclamation_show', ['id' => $reclamation->getId()]);
        }

        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->flush();

                $this->addFlash('success', 'Votre réclamation a été modifiée avec succès.');
                return $this->redirectToRoute('app_reclamation_index');
            } catch (\Exception $e) {
                // Log l'erreur et affiche un message utilisateur
                $this->addFlash('error', 'Une erreur est survenue lors de la modification de la réclamation.');
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        // Vérification de base pour tous les utilisateurs
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier que l'utilisateur est le propriétaire de la réclamation
        if ($reclamation->getUser() !== $user) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer cette réclamation.');
        }

        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            try {
                $entityManager->remove($reclamation);
                $entityManager->flush();
                $this->addFlash('success', 'La réclamation a été supprimée avec succès.');
            } catch (\Exception $e) {
                // Log l'erreur et affiche un message utilisateur
                $this->addFlash('error', 'Une erreur est survenue lors de la suppression de la réclamation.');
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->redirectToRoute('app_reclamation_index');
    }
}
