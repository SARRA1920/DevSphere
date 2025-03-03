<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Repository\PublicationRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/forum-search')]
class ForumSearchController extends AbstractController
{
    #[Route('/ajax', name: 'app_forum_search_ajax', methods: ['GET'])]
    public function search(Request $request, PublicationRepository $publicationRepository, LoggerInterface $logger): JsonResponse
    {
        try {
            $keyword = $request->query->get('keyword');
            $category = $request->query->get('category');
            
            $logger->info('Searching publications', [
                'keyword' => $keyword,
                'category' => $category
            ]);
            
            $publications = $publicationRepository->searchPublications($keyword, $category);
            
            $formattedPublications = [];
            foreach ($publications as $publication) {
                // Check if the current user is the owner of the publication
                $isOwner = false;
                if ($this->getUser() && $publication->getUser() === $this->getUser()) {
                    $isOwner = true;
                }
                
                $formattedPublications[] = [
                    'id' => $publication->getId(),
                    'title' => $publication->getTitre(),
                    'content' => $publication->getContenu(),
                    'date' => $publication->getDate()->format('d M Y H:i'),
                    'category' => $publication->getCategory()->getCategory()->getValue(),
                    'author' => $publication->getUser() ? $publication->getUser()->getEmail() : 'Anonymous',
                    'commentCount' => count($publication->getCommentaires()),
                    'isOwner' => $isOwner,
                    'url' => $this->generateUrl('app_forum_show', ['id' => $publication->getId()]),
                    'editUrl' => $this->generateUrl('app_forum_edit', ['id' => $publication->getId()]),
                    'deleteUrl' => $this->generateUrl('app_forum_delete', ['id' => $publication->getId()])
                ];
            }
            
            return new JsonResponse([
                'success' => true,
                'publications' => $formattedPublications
            ]);
        } catch (\Exception $e) {
            $logger->error('Error searching publications', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return new JsonResponse([
                'success' => false,
                'error' => 'Error searching publications: ' . $e->getMessage()
            ]);
        }
    }
    
    #[Route('/csrf-token/{action}/{id}', name: 'app_forum_search_csrf_token', methods: ['GET'])]
    public function getCsrfToken(string $action, Publication $publication): JsonResponse
    {
        // Generate a CSRF token for the specified action on the publication
        $token = $this->container->get('security.csrf.token_manager')
            ->getToken($action . $publication->getId())
            ->getValue();
        
        return new JsonResponse(['token' => $token]);
    }
}
