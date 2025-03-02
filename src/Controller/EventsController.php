<?php

namespace App\Controller;

use App\Entity\Events;
use App\Form\EventsType;
use App\Repository\EventsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\ParticipationsRepository;
use App\Repository\UserRepository;

#[Route('/events')]
final class EventsController extends AbstractController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Route(name: 'events_index', methods: ['GET'])]
    public function events_index(
        EventsRepository $eventsRepository, 
        PaginatorInterface $paginator, 
        Request $request
    ): Response {
        $query = $eventsRepository->createQueryBuilder('e')->getQuery();

        $pagination = $paginator->paginate(
            $query, // Query to paginate
            $request->query->getInt('page', 1), // Current page, defaults to 1
            3 // Items per page
        );

        return $this->render('events.html.twig', [
            'pagination' => $pagination,
        ]);
    }
    
    #[Route('/back', name: 'app_events_index', methods: ['GET'])]
    public function index(EventsRepository $eventsRepository, EntityManagerInterface $entityManager): Response
    {
        // Native SQL query to get the top 3 events with the most participations
        $conn = $entityManager->getConnection();
        $sql = "SELECT e.id, e.titre, COUNT(p.id) as participation_count 
                FROM participation p 
                JOIN events e ON p.id_e = e.id 
                GROUP BY e.id 
                ORDER BY participation_count DESC 
                LIMIT 3";

        // Execute the query
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $topEvents = $resultSet->fetchAllAssociative();

        return $this->render('admin/events/events.html.twig', [
            'events' => $eventsRepository->findAll(),
            'top_events' => $topEvents,
        ]);
    }

    
    #[Route('/new', name: 'app_events_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Events();
        $form = $this->createForm(EventsType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_events_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/events/add-event.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_events_show', methods: ['GET'])]
    public function show(Events $event): Response
    {
        return $this->render('events/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_events_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Events $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventsType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_events_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/events/update-events.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    

    #[Route('/{id}', name: 'app_events_delete', methods: ['POST'])]
    public function delete(Request $request, Events $event,EntityManagerInterface $entityManager, MailerInterface $mailer): Response {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->getPayload()->getString('_token'))) {
            // Retrieve participant emails using a DQL query
            $query = $entityManager->createQuery("
                SELECT u.email 
                FROM App\Entity\User u 
                JOIN App\Entity\Participation p WITH u.id = p.idU 
                WHERE p.idE = :event_id
            ")->setParameter('event_id', $event->getId());
    
            $emails = array_column($query->getResult(), 'email');
            // Send email notification to participants
            if (!empty($emails)) {
                $email = (new Email())
                    ->from('hamza.ghorbal@esprit.tn')
                    ->to(...$emails)
                    ->subject('Event Cancellation Notice')
                    ->text('We regret to inform you that the event you registered for has been canceled.');
    
                $mailer->send($email);
            }
    
            // Delete the event
            $entityManager->remove($event);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('app_events_index', [], Response::HTTP_SEE_OTHER);
    }

}
