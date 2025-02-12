<?php

namespace App\Controller;

use App\Entity\CategorieCours;
use App\Form\CategorieCoursType;
use App\Repository\CategorieCoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie/cours')]
class CategorieCoursController extends AbstractController
{
    #[Route('/', name: 'app_categorie_cours_index', methods: ['GET'])]
    public function index(CategorieCoursRepository $categorieCoursRepository): Response
    {
        return $this->render('categorie_cours/index.html.twig', [
            'categorie_cours' => $categorieCoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieCours = new CategorieCours();
        $form = $this->createForm(CategorieCoursType::class, $categorieCours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieCours);
            $entityManager->flush();

            $this->addFlash('success', 'Category created successfully!');
            return $this->redirectToRoute('app_categorie_cours_index');
        }

        return $this->render('categorie_cours/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_cours_show', methods: ['GET'])]
    public function show(CategorieCours $categorieCours): Response
    {
        return $this->render('categorie_cours/show.html.twig', [
            'categorie_cours' => $categorieCours,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieCours $categorieCours, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieCoursType::class, $categorieCours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Category updated successfully!');
            return $this->redirectToRoute('app_categorie_cours_index');
        }

        return $this->render('categorie_cours/edit.html.twig', [
            'categorie_cours' => $categorieCours,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_cours_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieCours $categorieCours, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieCours->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorieCours);
            $entityManager->flush();
            $this->addFlash('success', 'Category deleted successfully!');
        }

        return $this->redirectToRoute('app_categorie_cours_index');
    }
}
