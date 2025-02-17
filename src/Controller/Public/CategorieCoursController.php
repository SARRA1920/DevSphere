<?php

namespace App\Controller\Public;

use App\Entity\CategorieCours;
use App\Repository\CategorieCoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories')]
class CategorieCoursController extends AbstractController
{
    #[Route('/', name: 'public_categorie_cours_index', methods: ['GET'])]
    public function index(CategorieCoursRepository $categorieCoursRepository): Response
    {
        return $this->render('public/categorie_cours/index.html.twig', [
            'categories' => $categorieCoursRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'public_categorie_cours_show', methods: ['GET'])]
    public function show(CategorieCours $categorieCours): Response
    {
        return $this->render('public/categorie_cours/show.html.twig', [
            'category' => $categorieCours,
            'courses' => $categorieCours->getCours(),
        ]);
    }
}
