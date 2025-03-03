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
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mime\Email;

#[Route('/admin/reponse')]
#[IsGranted('ROLE_ADMIN')]
class ReponseController extends AbstractController
{
    #[Route('/reclamation/{id}/repondre', name: 'app_reponse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Reclamation $reclamation, TransportInterface $transport): Response
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
            try {
                $entityManager->persist($reponse);
                $reclamation->setReponse($reponse);
                $entityManager->flush();

                // Récupérer l'email du réclamateur
                $userEmail = $reclamation->getUser()->getEmail();
                
                // Créer l'email
                $email = (new Email())
                    ->from('arifaanas83@gmail.com')
                    ->to($userEmail)
                    ->subject('Réponse à votre réclamation - DevSphere')
                    ->html("
                        <h2>Réponse à votre réclamation</h2>
                        <p>Bonjour,</p>
                        <p>Votre réclamation de type \"{$reclamation->getType()}\" a reçu une réponse.</p>
                        <h3>Votre réclamation :</h3>
                        <p>{$reclamation->getReclamation()}</p>
                        <h3>Notre réponse :</h3>
                        <p>{$reponse->getReponse()}</p>
                        <p>Date de réponse : {$reponse->getDate()->format('d/m/Y H:i')}</p>
                        <p>Merci de votre confiance,<br>L'équipe DevSphere</p>
                    ");

                // Envoyer l'email directement
                $transport->send($email);

                $this->addFlash('success', 'La réponse a été envoyée avec succès et un email a été envoyé au réclamateur.');
            } catch (\Exception $e) {
                // Log détaillé de l'erreur
                error_log("Erreur détaillée lors de l'envoi de l'email: " . $e->getMessage());
                error_log("Stack trace: " . $e->getTraceAsString());
                $this->addFlash('warning', 'La réponse a été enregistrée mais l\'email n\'a pas pu être envoyé. Erreur: ' . $e->getMessage());
            }

            return $this->redirectToRoute('app_reclamation_show', ['id' => $reclamation->getId()]);
        }

        return $this->render('reponse/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reponse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reponse $reponse, EntityManagerInterface $entityManager, TransportInterface $transport): Response
    {
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->flush();

                // Trouver la réclamation associée
                $reclamation = $entityManager->getRepository(Reclamation::class)->findOneBy(['reponse' => $reponse]);
                
                if ($reclamation && $reclamation->getUser()) {
                    // Récupérer l'email du réclamateur
                    $userEmail = $reclamation->getUser()->getEmail();
                    
                    // Créer l'email
                    $email = (new Email())
                        ->from('arifaanas83@gmail.com')
                        ->to($userEmail)
                        ->subject('Mise à jour de la réponse à votre réclamation - DevSphere')
                        ->html("
                            <h2>Mise à jour de la réponse à votre réclamation</h2>
                            <p>Bonjour,</p>
                            <p>La réponse à votre réclamation de type \"{$reclamation->getType()}\" a été mise à jour.</p>
                            <h3>Votre réclamation :</h3>
                            <p>{$reclamation->getReclamation()}</p>
                            <h3>Notre nouvelle réponse :</h3>
                            <p>{$reponse->getReponse()}</p>
                            <p>Date de mise à jour : {$reponse->getDate()->format('d/m/Y H:i')}</p>
                            <p>Merci de votre confiance,<br>L'équipe DevSphere</p>
                        ");

                    // Envoyer l'email directement
                    $transport->send($email);
                    
                    $this->addFlash('success', 'La réponse a été modifiée avec succès et un email a été envoyé au réclamateur.');
                } else {
                    $this->addFlash('success', 'La réponse a été modifiée avec succès.');
                }
            } catch (\Exception $e) {
                error_log("Erreur détaillée lors de l'envoi de l'email de modification: " . $e->getMessage());
                error_log("Stack trace: " . $e->getTraceAsString());
                $this->addFlash('warning', 'La réponse a été modifiée mais l\'email n\'a pas pu être envoyé. Erreur: ' . $e->getMessage());
            }

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
