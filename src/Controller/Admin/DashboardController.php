<?php

namespace App\Controller\Admin;

use App\Repository\CategorieCoursRepository;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'admin_dashboard')]
    public function index(CategorieCoursRepository $categorieCoursRepository, CoursRepository $coursRepository): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'total_categories' => $categorieCoursRepository->count([]),
            'total_courses' => $coursRepository->count([]),
            'recent_categories' => $categorieCoursRepository->findBy([], ['id' => 'DESC'], 5),
            'recent_courses' => $coursRepository->findBy([], ['id' => 'DESC'], 5),
        ]);
    }
}
