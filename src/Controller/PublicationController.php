<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\Categoriepublication;
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
            // Verify CSRF token
            if (!$this->isCsrfTokenValid('create-publication', $request->request->get('token'))) {
                $this->addFlash('error', 'Invalid token');
                return $this->redirectToRoute('app_publication_new');
            }

            try {
                $publication = new Publication();
                $publication->setTitre($request->request->get('titre'))
                           ->setContenu($request->request->get('contenu'))
                           ->setDate(new \DateTime())
                           ->setUser($this->getUser());

                // Get the category if provided
                $categoryId = $request->request->get('categorie');
                if ($categoryId) {
                    $category = $entityManager->getRepository(Categoriepublication::class)->find($categoryId);
                    if ($category) {
                        $publication->setCategory($category);
                    }
                }

                $entityManager->persist($publication);
                $entityManager->flush();

                $this->addFlash('success', 'Publication created successfully!');
                return $this->redirectToRoute('app_publication_show', ['id' => $publication->getId()]);
            } catch (\Exception $e) {
                $this->addFlash('error', 'An error occurred while creating the publication: ' . $e->getMessage());
                return $this->redirectToRoute('app_publication_new');
            }
        }

        $categories = $entityManager->getRepository(Categoriepublication::class)->findAll();
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
            $publication->setTitre($request->request->get('titre'));

            // Update category if provided
            $categoryId = $request->request->get('categorie');
            if ($categoryId) {
                $category = $entityManager->getRepository(Categoriepublication::class)->find($categoryId);
                if ($category) {
                    $publication->setCategoriepublication($category);
                }
            }

            $entityManager->flush();

            $this->addFlash('success', 'Publication updated successfully!');
            return $this->redirectToRoute('app_publication_show', ['id' => $publication->getId()]);
        }

        $categories = $entityManager->getRepository(Categoriepublication::class)->findAll();
        return $this->render('publication/edit.html.twig', [
            'publication' => $publication,
            'categories' => $categories,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_publication_delete', methods: ['POST'])]
    public function delete(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publication->getId(), $request->request->get('_token'))) {
            $entityManager->remove($publication);
            $entityManager->flush();
            $this->addFlash('success', 'Publication deleted successfully!');
        }

        return $this->redirectToRoute('app_publication_index');
    }
}
