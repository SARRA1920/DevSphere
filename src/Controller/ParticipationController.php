<?php

namespace App\Controller;

use App\Entity\Participation;
use App\Entity\User;
use App\Entity\Events;
use App\Form\ParticipationType;
use App\Repository\ParticipationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\EventsRepository;




#[Route('/participation')]
final class ParticipationController extends AbstractController
{
    #[Route(name: 'app_participation_index', methods: ['GET'])]
    public function index(ParticipationRepository $participationRepository,Request $request): Response
    {
        $id_E = $request->query->get('id'); // Get id from URL
        $participations = $participationRepository->findBy(['idE' => $id_E]); // Find by id_e
        return $this->render('admin/events/participation.html.twig', [
            'participations' => $participations,
        ]);
    }

    #[Route('/{id}/myevents', name: 'myevents', methods: ['GET', 'POST'])]
    public function myevent(int $id, ParticipationRepository $participationRepository): Response
    {
        // Fetch participations by the user ID
        $participations = $participationRepository->findBy(['idU' => $this->getUser() ]);

        return $this->render('myevents.html.twig', [
            'participations' => $participations,
        ]);
    }


    #[Route('/{id}/new', name: 'app_participation_new', methods: ['GET', 'POST'])]
    public function new(int $id, EntityManagerInterface $entityManager, EventsRepository $eventsRepository, UserRepository $userRepository): Response
    {
        $participation = new Participation();
        
        // Fetch the event directly by its ID from the repository
        $event = $eventsRepository->find($id);
        
        if (!$event) {
            throw $this->createNotFoundException('Event not found.');
        }

        $participation->setIdE($event);

        $participation->setIdU($this->getUser());


        $entityManager->persist($participation);
        $entityManager->flush();

        return $this->redirectToRoute('events_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}/edit', name: 'app_participation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('participation/edit.html.twig', [
            'participation' => $participation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participation_delete', methods: ['POST'])]
    public function delete(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($participation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_events_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/f', name: 'app_participation_deletef', methods: ['POST'])]
    public function deletef(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($participation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('events_index', [], Response::HTTP_SEE_OTHER);
    }
}
