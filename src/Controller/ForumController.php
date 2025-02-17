<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\Commentaire;
use App\Entity\CategoriePublication;
use App\Repository\PublicationRepository;
use App\Repository\CategoriePublicationRepository;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/forum')]
final class ForumController extends AbstractController
{
    #[Route('/', name: 'app_forum')]
    public function index(CategoriePublicationRepository $categoriePublicationRepository): Response
    {
        return $this->render('forum/index.html.twig', [
            'categories' => $categoriePublicationRepository->findAll(),
        ]);
    }

    #[Route('/category/{id}', name: 'app_forum_category')]
    public function category(CategoriePublication $category, PublicationRepository $publicationRepository): Response
    {
        $publications = $publicationRepository->findBy(['category' => $category], ['date' => 'DESC']);
        
        return $this->render('forum/category.html.twig', [
            'category' => $category,
            'publications' => $publications,
        ]);
    }

    #[Route('/new', name: 'app_forum_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, CategoriePublicationRepository $categoryRepo): Response
    {
        if ($request->isMethod('POST')) {
            try {
                $publication = new Publication();
                $publication->setTitre($request->request->get('titre'))
                           ->setContenu($request->request->get('contenu'))
                           ->setDate(new \DateTime())
                           ->setUser($this->getUser());

                // Get the category
                $categoryId = $request->request->get('category');
                $category = $categoryRepo->find($categoryId);
                if (!$category) {
                    throw new \Exception('Category not found');
                }
                $publication->setCategory($category);

                $entityManager->persist($publication);
                $entityManager->flush();

                $this->addFlash('success', 'Your post has been published!');
                return $this->redirectToRoute('app_forum_show', ['id' => $publication->getId()]);
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error creating post: ' . $e->getMessage());
            }
        }

        return $this->render('forum/new.html.twig', [
            'categories' => $categoryRepo->findAll(),
        ]);
    }

    #[Route('/show/{id}', name: 'app_forum_show')]
    public function show(Publication $publication): Response
    {
        return $this->render('forum/show.html.twig', [
            'publication' => $publication,
        ]);
    }

    #[Route('/{id}/comment', name: 'app_forum_comment', methods: ['POST'])]
    public function addComment(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
    {
        try {
            $commentaire = new Commentaire();
            $commentaire->setContenu($request->request->get('contenu'))
                       ->setDate(new \DateTime())
                       ->setUser($this->getUser())
                       ->setPublication($publication);

            $entityManager->persist($commentaire);
            $entityManager->flush();

            $this->addFlash('success', 'Your comment has been added!');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Error adding comment: ' . $e->getMessage());
        }

        return $this->redirectToRoute('app_forum_show', ['id' => $publication->getId()]);
    }
}
