<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminDashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'admin_dashboard')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer les statistiques
        $totalUsers = $entityManager->getRepository(User::class)->count([]);
        $adminUsers = $entityManager->getRepository(User::class)->count(['role' => 'admin']);
        $regularUsers = $totalUsers - $adminUsers;

        return $this->render('admin/dashboard/index.html.twig', [
            'totalUsers' => $totalUsers,
            'adminUsers' => $adminUsers,
            'regularUsers' => $regularUsers,
        ]);
    }
}
