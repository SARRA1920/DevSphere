<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Reclamation;
use App\Repository\ReclamationRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReclamationType;

final class ReclamationController extends AbstractController
{
    #[Route('/reclamation', name: 'app_reclamation')]
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }
    #[Route('/readfreclamation', name: 'reclamation_index')]
    public function readf(ManagerRegistry $doctrine): Response
    {
        $reclamationRepository = $doctrine->getRepository(Reclamation::class);
        $reclamations = $reclamationRepository->findAll();

        return $this->render('reclamation/readfreclamation.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }
    #[Route('/reclamation/add', name: 'reclamation_add')]
public function add(Request $request, ManagerRegistry $doctrine): Response
{
    $reclamation = new Reclamation(); // Ensure ID is null
    $form = $this->createForm(ReclamationType::class, $reclamation);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $doctrine->getManager();
        $reclamation->setDate(new \DateTime()); // Set the current date or handle it as needed
        $entityManager->persist($reclamation);
        $entityManager->flush();

        return $this->redirectToRoute('reclamation_index'); // Redirect to the list of reclamations
    }

    return $this->render('reclamation/addreclamation.html.twig', [
        'form' => $form->createView(),
    ]);
}
    #[Route('/reclamation/delete/{id}', name: 'reclamation_delete')]
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $reclamationRepository = $doctrine->getRepository(Reclamation::class);
        $reclamation = $reclamationRepository->find($id);

        if ($reclamation) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reclamation_index');
    }
    #[Route('/reclamation/edit/{id}', name: 'reclamation_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $reclamationRepository = $doctrine->getRepository(Reclamation::class);
        $reclamation = $reclamationRepository->find($id);
    
        if (!$reclamation) {
            throw $this->createNotFoundException('Reclamation not found');
        }
    
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->flush();
    
            return $this->redirectToRoute('reclamation_index');
        }
    
        return $this->render('reclamation/editreclamation.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
