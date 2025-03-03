<?php

namespace App\Controller;

use App\Entity\Reaction;
use App\Entity\Publication;
use App\Entity\Commentaire;
use App\Repository\ReactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Psr\Log\LoggerInterface;

#[Route('/forum/reaction')]
class ForumReactionController extends AbstractController
{
    /**
     * Valid reaction types
     */
    private const VALID_REACTION_TYPES = [
        'like',
        'love',
        'haha',
        'wow',
        'sad',
        'angry'
    ];
    
    /**
     * Validates if a reaction type is valid
     */
    private function isValidReactionType(string $type): bool
    {
        return in_array($type, self::VALID_REACTION_TYPES);
    }

    #[Route('/debug', name: 'app_forum_reaction_debug')]
    public function debug(LoggerInterface $logger): Response
    {
        $logger->info('Debug route accessed');
        return new Response('ForumReactionController is working!');
    }
    
    #[Route('/publication/{id}/{type}', name: 'app_forum_reaction_publication', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function reactToPublication(
        Publication $publication, 
        string $type, 
        EntityManagerInterface $entityManager,
        ReactionRepository $reactionRepository,
        LoggerInterface $logger,
        Request $request
    ): JsonResponse {
        $logger->info('Publication reaction route accessed', [
            'publication_id' => $publication->getId(),
            'reaction_type' => $type,
            'user_id' => $this->getUser() ? $this->getUser()->getId() : null,
            'request_method' => $request->getMethod(),
            'content_type' => $request->headers->get('Content-Type'),
            'csrf_token' => $request->headers->get('X-CSRF-TOKEN'),
        ]);
        
        // Validate CSRF token
        $submittedToken = $request->headers->get('X-CSRF-TOKEN');
        if (!$this->isCsrfTokenValid('reaction', $submittedToken)) {
            $logger->warning('Invalid CSRF token', [
                'submitted_token' => $submittedToken
            ]);
            return new JsonResponse(['success' => false, 'message' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }
        
        // Validate reaction type
        if (!$this->isValidReactionType($type)) {
            $logger->warning('Invalid reaction type', [
                'type' => $type
            ]);
            return new JsonResponse(['success' => false, 'message' => 'Invalid reaction type'], Response::HTTP_BAD_REQUEST);
        }
        
        $user = $this->getUser();
        
        if (!$user) {
            $logger->warning('Unauthorized reaction attempt');
            return new JsonResponse(['success' => false, 'message' => 'You must be logged in to react'], Response::HTTP_UNAUTHORIZED);
        }
        
        // Check if user already reacted with this type
        $existingReaction = $reactionRepository->findOneBy([
            'publication' => $publication,
            'user' => $user,
            'type' => $type
        ]);
        
        if ($existingReaction) {
            $logger->info('Removing existing reaction', [
                'reaction_id' => $existingReaction->getId(),
                'reaction_type' => $existingReaction->getType()
            ]);
            
            // Remove the reaction if it already exists (toggle behavior)
            $entityManager->remove($existingReaction);
            $entityManager->flush();
            
            // Count reactions by type
            $reactionCounts = $this->countReactionsByType($publication->getReactions());
            
            $logger->info('Reaction removed successfully', [
                'counts' => $reactionCounts
            ]);
            
            return new JsonResponse([
                'success' => true, 
                'action' => 'removed',
                'counts' => $reactionCounts,
                'userReaction' => null
            ]);
        }
        
        // Check if user already reacted with a different type
        $otherReaction = $reactionRepository->findOneBy([
            'publication' => $publication,
            'user' => $user
        ]);
        
        if ($otherReaction) {
            $logger->info('Removing other reaction type', [
                'reaction_id' => $otherReaction->getId(),
                'reaction_type' => $otherReaction->getType()
            ]);
            
            // Remove the other reaction type
            $entityManager->remove($otherReaction);
        }
        
        // Create new reaction
        $reaction = new Reaction();
        $reaction->setPublication($publication);
        $reaction->setUser($user);
        $reaction->setType($type);
        $reaction->setCreatedAt(new \DateTime()); // Make sure to set createdAt
        
        $entityManager->persist($reaction);
        $entityManager->flush();
        
        // Count reactions by type
        $reactionCounts = $this->countReactionsByType($publication->getReactions());
        
        $logger->info('New reaction added successfully', [
            'reaction_type' => $type,
            'counts' => $reactionCounts
        ]);
        
        return new JsonResponse([
            'success' => true, 
            'action' => 'added',
            'counts' => $reactionCounts,
            'userReaction' => $type
        ]);
    }
    
    #[Route('/commentaire/{id}/{type}', name: 'app_forum_reaction_commentaire', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function reactToCommentaire(
        Commentaire $commentaire, 
        string $type, 
        EntityManagerInterface $entityManager,
        ReactionRepository $reactionRepository,
        LoggerInterface $logger,
        Request $request
    ): JsonResponse {
        $logger->info('Comment reaction route accessed', [
            'comment_id' => $commentaire->getId(),
            'reaction_type' => $type,
            'user_id' => $this->getUser() ? $this->getUser()->getId() : null,
            'request_method' => $request->getMethod(),
            'content_type' => $request->headers->get('Content-Type'),
            'csrf_token' => $request->headers->get('X-CSRF-TOKEN'),
        ]);
        
        // Validate CSRF token
        $submittedToken = $request->headers->get('X-CSRF-TOKEN');
        if (!$this->isCsrfTokenValid('reaction', $submittedToken)) {
            $logger->warning('Invalid CSRF token', [
                'submitted_token' => $submittedToken
            ]);
            return new JsonResponse(['success' => false, 'message' => 'Invalid CSRF token'], Response::HTTP_FORBIDDEN);
        }
        
        // Validate reaction type
        if (!$this->isValidReactionType($type)) {
            $logger->warning('Invalid reaction type', [
                'type' => $type
            ]);
            return new JsonResponse(['success' => false, 'message' => 'Invalid reaction type'], Response::HTTP_BAD_REQUEST);
        }
        
        $user = $this->getUser();
        
        if (!$user) {
            $logger->warning('Unauthorized reaction attempt');
            return new JsonResponse(['success' => false, 'message' => 'You must be logged in to react'], Response::HTTP_UNAUTHORIZED);
        }
        
        // Check if user already reacted with this type
        $existingReaction = $reactionRepository->findOneBy([
            'commentaire' => $commentaire,
            'user' => $user,
            'type' => $type
        ]);
        
        if ($existingReaction) {
            $logger->info('Removing existing reaction', [
                'reaction_id' => $existingReaction->getId(),
                'reaction_type' => $existingReaction->getType()
            ]);
            
            // Remove the reaction if it already exists (toggle behavior)
            $entityManager->remove($existingReaction);
            $entityManager->flush();
            
            // Count reactions by type
            $reactionCounts = $this->countReactionsByType($commentaire->getReactions());
            
            $logger->info('Reaction removed successfully', [
                'counts' => $reactionCounts
            ]);
            
            return new JsonResponse([
                'success' => true, 
                'action' => 'removed',
                'counts' => $reactionCounts,
                'userReaction' => null
            ]);
        }
        
        // Check if user already reacted with a different type
        $otherReaction = $reactionRepository->findOneBy([
            'commentaire' => $commentaire,
            'user' => $user
        ]);
        
        if ($otherReaction) {
            $logger->info('Removing other reaction type', [
                'reaction_id' => $otherReaction->getId(),
                'reaction_type' => $otherReaction->getType()
            ]);
            
            // Remove the other reaction type
            $entityManager->remove($otherReaction);
        }
        
        // Create new reaction
        $reaction = new Reaction();
        $reaction->setCommentaire($commentaire);
        $reaction->setUser($user);
        $reaction->setType($type);
        $reaction->setCreatedAt(new \DateTime()); // Make sure to set createdAt
        
        $entityManager->persist($reaction);
        $entityManager->flush();
        
        // Count reactions by type
        $reactionCounts = $this->countReactionsByType($commentaire->getReactions());
        
        $logger->info('New reaction added successfully', [
            'reaction_type' => $type,
            'counts' => $reactionCounts
        ]);
        
        return new JsonResponse([
            'success' => true, 
            'action' => 'added',
            'counts' => $reactionCounts,
            'userReaction' => $type
        ]);
    }
    
    #[Route('/{targetType}/{id}/{type}', name: 'app_forum_reaction_generic', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function handleGenericReaction(
        string $targetType,
        int $id,
        string $type,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger,
        Request $request
    ): Response {
        $logger->info('Generic reaction route accessed', [
            'target_type' => $targetType,
            'target_id' => $id,
            'reaction_type' => $type,
            'method' => $request->getMethod()
        ]);
        
        // Validate reaction type
        if (!$this->isValidReactionType($type)) {
            $logger->warning('Invalid reaction type', [
                'type' => $type
            ]);
            if ($request->getMethod() === 'GET') {
                $this->addFlash('error', 'Invalid reaction type');
                return $this->redirectToRoute('app_forum_index');
            } else {
                return new JsonResponse(['success' => false, 'message' => 'Invalid reaction type'], Response::HTTP_BAD_REQUEST);
            }
        }
        
        // Validate target type
        if (!in_array($targetType, ['publication', 'commentaire'])) {
            $logger->warning('Invalid target type', [
                'target_type' => $targetType
            ]);
            if ($request->getMethod() === 'GET') {
                $this->addFlash('error', 'Invalid target type');
                return $this->redirectToRoute('app_forum_index');
            } else {
                return new JsonResponse(['success' => false, 'message' => 'Invalid target type'], Response::HTTP_BAD_REQUEST);
            }
        }
        
        // If it's a GET request, redirect to the publication or comment
        if ($request->getMethod() === 'GET') {
            if ($targetType === 'publication') {
                $publication = $entityManager->getRepository(Publication::class)->find($id);
                if (!$publication) {
                    throw $this->createNotFoundException('Publication not found');
                }
                return $this->redirectToRoute('app_forum_show', ['id' => $publication->getId()]);
            } elseif ($targetType === 'commentaire') {
                $comment = $entityManager->getRepository(Commentaire::class)->find($id);
                if (!$comment) {
                    throw $this->createNotFoundException('Comment not found');
                }
                return $this->redirectToRoute('app_forum_show', ['id' => $comment->getPublication()->getId()]);
            }
        }
        
        // If it's a POST request, forward to the appropriate controller method
        if ($targetType === 'publication') {
            $publication = $entityManager->getRepository(Publication::class)->find($id);
            if (!$publication) {
                throw $this->createNotFoundException('Publication not found');
            }
            return $this->forward(self::class . '::reactToPublication', [
                'publication' => $publication,
                'type' => $type
            ]);
        } elseif ($targetType === 'commentaire') {
            $comment = $entityManager->getRepository(Commentaire::class)->find($id);
            if (!$comment) {
                throw $this->createNotFoundException('Comment not found');
            }
            return $this->forward(self::class . '::reactToCommentaire', [
                'commentaire' => $comment,
                'type' => $type
            ]);
        }
        
        throw $this->createNotFoundException('Invalid target type');
    }
    
    #[Route('/debug-request', name: 'app_forum_reaction_debug_request')]
    public function debugRequest(Request $request, LoggerInterface $logger): Response
    {
        $logger->info('Debug request route accessed', [
            'method' => $request->getMethod(),
            'content_type' => $request->headers->get('Content-Type'),
            'csrf_token' => $request->headers->get('X-CSRF-TOKEN'),
            'uri' => $request->getUri(),
            'path' => $request->getPathInfo(),
            'query' => $request->query->all(),
            'request' => $request->request->all(),
            'headers' => $request->headers->all(),
        ]);
        
        return new JsonResponse([
            'success' => true,
            'message' => 'Request details logged',
            'uri' => $request->getUri(),
            'path' => $request->getPathInfo(),
        ]);
    }
    
    /**
     * Helper method to count reactions by type
     */
    private function countReactionsByType(iterable $reactions): array
    {
        $counts = [
            'like' => 0,
            'love' => 0,
            'haha' => 0,
            'wow' => 0,
            'sad' => 0,
            'angry' => 0
        ];
        
        foreach ($reactions as $reaction) {
            $type = $reaction->getType();
            if (isset($counts[$type])) {
                $counts[$type]++;
            }
        }
        
        return $counts;
    }
}
