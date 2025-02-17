<?php

namespace App\Controller;

use App\Entity\CategoriePublication;
use App\Repository\CategoriePublicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categorie')]
class CategoriePublicationController extends AbstractController
{
    #[Route('/', name: 'app_categorie_index', methods: ['GET'])]
    public function index(CategoriePublicationRepository $categoriePublicationRepository): Response
    {
        return $this->render('categorie_publication/index.html.twig', [
            'categories' => $categoriePublicationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            try {
                $categorie = new CategoriePublication();
                $categorie->setName($request->request->get('name'))
                         ->setDescription($request->request->get('description'));

                $entityManager->persist($categorie);
                $entityManager->flush();

                $this->addFlash('success', 'Category created successfully!');
                return $this->redirectToRoute('app_categorie_index');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error creating category: ' . $e->getMessage());
            }
        }

        return $this->render('categorie_publication/new.html.twig');
    }

    #[Route('/{id}', name: 'app_categorie_show', methods: ['GET'])]
    public function show(CategoriePublication $categorie): Response
    {
        return $this->render('categorie_publication/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategoriePublication $categorie, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            try {
                $categorie->setName($request->request->get('name'))
                         ->setDescription($request->request->get('description'));

                $entityManager->flush();
                $this->addFlash('success', 'Category updated successfully!');
                return $this->redirectToRoute('app_categorie_show', ['id' => $categorie->getId()]);
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error updating category: ' . $e->getMessage());
            }
        }

        return $this->render('categorie_publication/edit.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_delete', methods: ['POST'])]
    public function delete(Request $request, CategoriePublication $categorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            try {
                $entityManager->remove($categorie);
                $entityManager->flush();
                $this->addFlash('success', 'Category deleted successfully!');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error deleting category: ' . $e->getMessage());
            }
        }

        return $this->redirectToRoute('app_categorie_index');
    }
}
