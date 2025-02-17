<?php

namespace App\Controller\Admin;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/cours')]
#[IsGranted('ROLE_ADMIN')]
class CoursController extends AbstractController
{
    #[Route('/', name: 'admin_cours_index', methods: ['GET'])]
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('admin/cours/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // Set default image
                $cour->setImage('default-course.jpg');
                
                $entityManager->persist($cour);
                $entityManager->flush();

                $this->addFlash('success', 'Course created successfully!');
                return $this->redirectToRoute('admin_cours_index', [], Response::HTTP_SEE_OTHER);
            } catch (\Exception $e) {
                $this->addFlash('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        return $this->renderForm('admin/cours/new.html.twig', [
            'cours' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cours $cours, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->flush();

                $this->addFlash('success', 'Course updated successfully!');
                return $this->redirectToRoute('admin_cours_index', [], Response::HTTP_SEE_OTHER);
            } catch (\Exception $e) {
                $this->addFlash('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        return $this->renderForm('admin/cours/edit.html.twig', [
            'cours' => $cours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_cours_delete', methods: ['POST'])]
    public function delete(Request $request, Cours $cours, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cours->getId(), $request->request->get('_token'))) {
            try {
                $entityManager->remove($cours);
                $entityManager->flush();
                $this->addFlash('success', 'Course deleted successfully!');
            } catch (\Exception $e) {
                $this->addFlash('error', 'An error occurred while deleting the course: ' . $e->getMessage());
            }
        }

        return $this->redirectToRoute('admin_cours_index', [], Response::HTTP_SEE_OTHER);
    }
}
