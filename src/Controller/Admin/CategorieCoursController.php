<?php

namespace App\Controller\Admin;

use App\Entity\CategorieCours;
use App\Form\CategorieCoursType;
use App\Repository\CategorieCoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\AbstractAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/categorie/cours')]
#[IsGranted('ROLE_ADMIN')]
class CategorieCoursController extends AbstractAdminController
{
    #[Route('/', name: 'admin_categorie_cours_index', methods: ['GET'])]
    public function index(CategorieCoursRepository $categorieCoursRepository): Response
    {
        return $this->render('admin/categorie_cours/index.html.twig', [
            'categorie_cours' => $categorieCoursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_categorie_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorieCours = new CategorieCours();
        $form = $this->createForm(CategorieCoursType::class, $categorieCours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorieCours);
            $entityManager->flush();

            $this->addFlash('success', 'Category created successfully!');
            return $this->redirectToRoute('admin_categorie_cours_index');
        }

        return $this->render('admin/categorie_cours/new.html.twig', [
            'categorie_cours' => $categorieCours,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_categorie_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieCours $categorieCours, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieCoursType::class, $categorieCours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Category updated successfully!');
            return $this->redirectToRoute('admin_categorie_cours_index');
        }

        return $this->render('admin/categorie_cours/edit.html.twig', [
            'categorie_cours' => $categorieCours,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'admin_categorie_cours_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieCours $categorieCours, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieCours->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorieCours);
            $entityManager->flush();
            $this->addFlash('success', 'Category deleted successfully!');
        }

        return $this->redirectToRoute('admin_categorie_cours_index');
    }
}
