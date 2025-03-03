<?php

namespace App\Controller;

use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Psr\Log\LoggerInterface;

#[Route('/admin/reclamation/stats')]
#[IsGranted('ROLE_ADMIN')]
class ReclamationStatsController extends AbstractController
{
    #[Route('/', name: 'app_reclamation_stats')]
    public function index(ReclamationRepository $reclamationRepository, LoggerInterface $logger): Response
    {
        try {
            // Récupérer les statistiques
            $stats = $reclamationRepository->getStatsByType();
            
            // Convertir les résultats en tableau associatif
            $stats = array_map(function($stat) {
                return [
                    'type' => $stat['type'],
                    'count' => (int)$stat['count']
                ];
            }, $stats);
            
            // Calculer le total
            $total = array_sum(array_column($stats, 'count'));
            
            // Préparer les données pour le graphique
            $chartData = [
                'labels' => array_column($stats, 'type'),
                'data' => array_column($stats, 'count'),
                'backgroundColor' => array_map(function() {
                    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }, $stats)
            ];

            return $this->render('reclamation_stats/index.html.twig', [
                'stats' => $stats,
                'chartData' => $chartData,
                'total' => $total
            ]);
            
        } catch (\Exception $e) {
            $logger->error('Erreur lors de la génération des statistiques', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            $this->addFlash('error', 'Une erreur est survenue lors de la génération des statistiques.');
            return $this->redirectToRoute('app_reclamation_index');
        }
    }
}
