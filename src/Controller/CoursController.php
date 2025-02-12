<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\CategorieCours;
use App\Entity\InscriptionCours;
use App\Form\CoursType;
use App\Form\InscriptionCoursType;
use App\Repository\CoursRepository;
use App\Repository\CategorieCoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cours')]
class CoursController extends AbstractController
{
    #[Route('/', name: 'app_cours_index', methods: ['GET'])]
    public function index(CoursRepository $coursRepository, CategorieCoursRepository $categorieCoursRepository, Request $request): Response
    {
        $selectedCategory = $request->query->get('category');
        $query = $coursRepository->createQueryBuilder('c');

        if ($selectedCategory) {
            $query->andWhere('c.categorieCours = :category')
                  ->setParameter('category', $selectedCategory);
        }

        $cours = $query->getQuery()->getResult();
        $categories = $categorieCoursRepository->findAll();

        return $this->render('cours/index.html.twig', [
            'cours' => $cours,
            'categories' => $categories,
            'selected_category' => $selectedCategory,
        ]);
    }

    #[Route('/new', name: 'app_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cours);
            $entityManager->flush();

            return $this->redirectToRoute('app_cours_index');
        }

        return $this->render('cours/new.html.twig', [
            'cours' => $cours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cours_show', methods: ['GET', 'POST'])]
    public function show(Request $request, CoursRepository $coursRepository, EntityManagerInterface $entityManager): Response
    {
        $id = $request->attributes->get('id');
        $cours = $coursRepository->find($id);
        
        if (!$cours) {
            throw $this->createNotFoundException('Course not found');
        }

        $inscription = new InscriptionCours();
        $inscription->setCours($cours);
        
        $form = $this->createForm(InscriptionCoursType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                try {
                    $entityManager->persist($inscription);
                    $entityManager->flush();
                    $this->addFlash('success', 'Thank you for registering! We will contact you shortly.');
                } catch (\Exception $e) {
                    $this->addFlash('error', 'An error occurred while saving your registration. Error: ' . $e->getMessage());
                }
            } else {
                foreach ($form->getErrors(true) as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
            return $this->redirectToRoute('app_cours_show', ['id' => $cours->getId()]);
        }

        // Debug code
        dump($cours);
        dump($inscription);
        dump($form);

        return $this->render('cours/show.html.twig', [
            'cours' => $cours,
            'inscriptionForm' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cours $cours, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cours_index');
        }

        return $this->render('cours/edit.html.twig', [
            'cours' => $cours,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_cours_delete', methods: ['POST'])]
    public function delete(Request $request, Cours $cours, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cours->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cours);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cours_index');
    }
}
