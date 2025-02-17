<?php

namespace App\Controller\Admin;

use App\Entity\Tentative;
use App\Form\TentativeType;
use App\Repository\TentativeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/tentative')]
#[IsGranted('ROLE_ADMIN')]
class TentativeController extends AbstractController
{
    #[Route('/', name: 'admin_tentative_index', methods: ['GET'])]
    public function index(TentativeRepository $tentativeRepository): Response
    {
        return $this->render('admin/tentative/index.html.twig', [
            'tentatives' => $tentativeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_tentative_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tentative = new Tentative();
        $form = $this->createForm(TentativeType::class, $tentative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tentative->setDateCreation(new \DateTime());
            $entityManager->persist($tentative);
            $entityManager->flush();

            $this->addFlash('success', 'La tentative a été créée avec succès.');
            return $this->redirectToRoute('admin_tentative_index');
        }

        return $this->render('admin/tentative/new.html.twig', [
            'tentative' => $tentative,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'admin_tentative_show', methods: ['GET'])]
    public function show(Tentative $tentative): Response
    {
        return $this->render('admin/tentative/show.html.twig', [
            'tentative' => $tentative,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_tentative_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tentative $tentative, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TentativeType::class, $tentative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'La tentative a été modifiée avec succès.');
            return $this->redirectToRoute('admin_tentative_index');
        }

        return $this->render('admin/tentative/edit.html.twig', [
            'tentative' => $tentative,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'admin_tentative_delete', methods: ['POST'])]
    public function delete(Request $request, Tentative $tentative, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tentative->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tentative);
            $entityManager->flush();
            $this->addFlash('success', 'La tentative a été supprimée avec succès.');
        }

        return $this->redirectToRoute('admin_tentative_index');
    }
}
