<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\CategoriePublication;
use App\Repository\PublicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/publication')]
class PublicationController extends AbstractController
{
    #[Route('/', name: 'app_publication_index', methods: ['GET'])]
    public function index(PublicationRepository $publicationRepository): Response
    {
        return $this->render('publication/index.html.twig', [
            'publications' => $publicationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_publication_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            try {
                $publication = new Publication();
                $publication->setTitre($request->request->get('titre'))
                           ->setContenu($request->request->get('contenu'))
                           ->setDate(new \DateTime())
                           ->setUser($this->getUser());

                // Get the category if provided
                $categoryId = $request->request->get('categorie');
                if ($categoryId) {
                    $category = $entityManager->getRepository(CategoriePublication::class)->find($categoryId);
                    if ($category) {
                        $publication->setCategory($category);
                    } else {
                        throw new \Exception('Category not found');
                    }
                } else {
                    throw new \Exception('Category is required');
                }

                $entityManager->persist($publication);
                $entityManager->flush();

                $this->addFlash('success', 'Publication created successfully!');
                return $this->redirectToRoute('app_publication_show', ['id' => $publication->getId()]);
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error creating publication: ' . $e->getMessage());
            }
        }

        // Get categories for the form
        $categories = $entityManager->getRepository(CategoriePublication::class)->findAll();
        return $this->render('publication/new.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/{id}', name: 'app_publication_show', methods: ['GET'])]
    public function show(Publication $publication): Response
    {
        return $this->render('publication/show.html.twig', [
            'publication' => $publication,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_publication_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            try {
                $publication->setTitre($request->request->get('titre'))
                           ->setContenu($request->request->get('contenu'));

                $categoryId = $request->request->get('categorie');
                if ($categoryId) {
                    $category = $entityManager->getRepository(CategoriePublication::class)->find($categoryId);
                    if ($category) {
                        $publication->setCategory($category);
                    } else {
                        throw new \Exception('Category not found');
                    }
                }

                $entityManager->flush();
                $this->addFlash('success', 'Publication updated successfully!');
                return $this->redirectToRoute('app_publication_show', ['id' => $publication->getId()]);
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error updating publication: ' . $e->getMessage());
            }
        }

        $categories = $entityManager->getRepository(CategoriePublication::class)->findAll();
        return $this->render('publication/edit.html.twig', [
            'publication' => $publication,
            'categories' => $categories,
        ]);
    }

    #[Route('/{id}', name: 'app_publication_delete', methods: ['POST'])]
    public function delete(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publication->getId(), $request->request->get('_token'))) {
            try {
                $entityManager->remove($publication);
                $entityManager->flush();
                $this->addFlash('success', 'Publication deleted successfully!');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error deleting publication: ' . $e->getMessage());
            }
        }

        return $this->redirectToRoute('app_publication_index');
    }
}
