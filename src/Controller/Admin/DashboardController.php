<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AbstractAdminController;
use App\Repository\CategorieCoursRepository;
use App\Repository\CoursRepository;
use App\Repository\InscriptionRepository;
use App\Repository\PublicationRepository;
use App\Repository\ExerciceRepository;
use App\Repository\TentativeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractAdminController
{
    #[Route('', name: 'admin_dashboard', methods: ['GET'])]
    public function index(
        CategorieCoursRepository $categorieCoursRepository,
        CoursRepository $coursRepository,
        InscriptionRepository $inscriptionRepository,
        PublicationRepository $publicationRepository,
        ExerciceRepository $exerciceRepository,
        TentativeRepository $tentativeRepository
    ): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'total_categories' => $categorieCoursRepository->count([]),
            'total_courses' => $coursRepository->count([]),
            'total_inscriptions' => $inscriptionRepository->count([]),
            'total_publications' => $publicationRepository->count([]),
            'total_exercices' => $exerciceRepository->count([]),
            'recent_categories' => $categorieCoursRepository->findBy([], ['id' => 'DESC'], 5),
            'recent_courses' => $coursRepository->findBy([], ['id' => 'DESC'], 5),
            'recent_exercices' => $exerciceRepository->findBy([], ['id' => 'DESC'], 5),
            'tentative_reussies' => $tentativeRepository->countSuccessfulTentatives(),
            'tentative_total' => $tentativeRepository->count([]),
            'tentative_moyenne' => $tentativeRepository->getAverageScore(),
            'recent_tentatives' => $tentativeRepository->findLatestTentatives(5),
        ]);
    }
}
