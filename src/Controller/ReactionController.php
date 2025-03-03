<?php

namespace App\Controller;

use App\Entity\Reaction;
use App\Entity\Publication;
use App\Entity\Commentaire;
use App\Entity\User;
use App\Repository\ReactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Psr\Log\LoggerInterface;

#[Route('/api/reaction')]
class ReactionController extends AbstractController
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

    #[Route('/debug', name: 'app_reaction_debug')]
    public function debug(LoggerInterface $logger): Response
    {
        $logger->info('Debug route accessed in ReactionController');
        return new Response('ReactionController is working!');
    }
    
    #[Route('/{targetType}/{targetId}/{reactionType}', name: 'app_reaction_generic', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function handleReaction(
        string $targetType,
        int $targetId,
        string $reactionType,
        Request $request,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ): JsonResponse
    {
        $logger->info('Handling reaction request', [
            'targetType' => $targetType,
            'targetId' => $targetId,
            'reactionType' => $reactionType
        ]);
        
        // Validate reaction type
        if (!$this->isValidReactionType($reactionType)) {
            $logger->error('Invalid reaction type', ['reactionType' => $reactionType]);
            return new JsonResponse([
                'success' => false,
                'error' => 'Invalid reaction type'
            ], 400);
        }
        
        // Check if user is logged in
        $user = $this->getUser();
        if (!$user) {
            $logger->error('User not authenticated');
            return new JsonResponse([
                'success' => false,
                'error' => 'User not authenticated'
            ], 401);
        }
        
        // Handle based on target type
        try {
            if ($targetType === 'publication') {
                $publication = $entityManager->getRepository(Publication::class)->find($targetId);
                if (!$publication) {
                    $logger->error('Publication not found', ['publicationId' => $targetId]);
                    return new JsonResponse([
                        'success' => false,
                        'error' => 'Publication not found'
                    ], 404);
                }
                
                return $this->handlePublicationReaction($publication, $reactionType, $user, $entityManager, $logger);
            } elseif ($targetType === 'commentaire') {
                $commentaire = $entityManager->getRepository(Commentaire::class)->find($targetId);
                if (!$commentaire) {
                    $logger->error('Comment not found', ['commentId' => $targetId]);
                    return new JsonResponse([
                        'success' => false,
                        'error' => 'Comment not found'
                    ], 404);
                }
                
                return $this->handleCommentaireReaction($commentaire, $reactionType, $user, $entityManager, $logger);
            } else {
                $logger->error('Invalid target type', ['targetType' => $targetType]);
                return new JsonResponse([
                    'success' => false,
                    'error' => 'Invalid target type'
                ], 400);
            }
        } catch (\Exception $e) {
            $logger->error('Error handling reaction', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return new JsonResponse([
                'success' => false,
                'error' => 'An error occurred while processing the reaction'
            ], 500);
        }
    }

    private function handlePublicationReaction(
        Publication $publication, 
        string $type,
        User $user,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ): JsonResponse {
        // Check if user already has a reaction
        $existingReaction = null;
        foreach ($publication->getReactions() as $reaction) {
            if ($reaction->getUser() === $user) {
                $existingReaction = $reaction;
                break;
            }
        }

        // If user already has this reaction, remove it (toggle off)
        if ($existingReaction && $existingReaction->getType() === $type) {
            $logger->info('Removing existing reaction', [
                'publicationId' => $publication->getId(),
                'reactionType' => $type,
                'userId' => $user->getId()
            ]);
            
            $entityManager->remove($existingReaction);
            $entityManager->flush();
            
            // Count reactions by type
            $reactionCounts = $this->countReactionsByType($publication->getReactions());
            $logger->info('Reaction counts after removal', ['counts' => $reactionCounts]);
            
            return new JsonResponse([
                'success' => true,
                'message' => 'Reaction removed',
                'reactionCounts' => $reactionCounts,
                'userReaction' => null
            ]);
        }
        
        // If user has a different reaction, update it
        if ($existingReaction) {
            $logger->info('Updating existing reaction', [
                'publicationId' => $publication->getId(),
                'oldType' => $existingReaction->getType(),
                'newType' => $type,
                'userId' => $user->getId()
            ]);
            
            $existingReaction->setType($type);
        } else {
            // Create new reaction
            $logger->info('Creating new reaction', [
                'publicationId' => $publication->getId(),
                'reactionType' => $type,
                'userId' => $user->getId()
            ]);
            
            $reaction = new Reaction();
            $reaction->setPublication($publication);
            $reaction->setType($type);
            $reaction->setUser($user);
            $reaction->setCreatedAt(new \DateTime());
            
            $entityManager->persist($reaction);
        }
        
        $entityManager->flush();
        
        // Count reactions by type
        $reactionCounts = $this->countReactionsByType($publication->getReactions());
        $logger->info('Reaction counts after add/update', ['counts' => $reactionCounts]);
        
        return new JsonResponse([
            'success' => true,
            'message' => 'Reaction added',
            'reactionCounts' => $reactionCounts,
            'userReaction' => $type
        ]);
    }

    private function handleCommentaireReaction(
        Commentaire $commentaire, 
        string $type,
        User $user,
        EntityManagerInterface $entityManager,
        LoggerInterface $logger
    ): JsonResponse {
        // Check if user already has a reaction
        $existingReaction = null;
        foreach ($commentaire->getReactions() as $reaction) {
            if ($reaction->getUser() === $user) {
                $existingReaction = $reaction;
                break;
            }
        }

        // If user already has this reaction, remove it (toggle off)
        if ($existingReaction && $existingReaction->getType() === $type) {
            $logger->info('Removing existing reaction', [
                'commentaireId' => $commentaire->getId(),
                'reactionType' => $type,
                'userId' => $user->getId()
            ]);
            
            $entityManager->remove($existingReaction);
            $entityManager->flush();
            
            // Count reactions by type
            $reactionCounts = $this->countReactionsByType($commentaire->getReactions());
            $logger->info('Reaction counts after removal', ['counts' => $reactionCounts]);
            
            return new JsonResponse([
                'success' => true,
                'message' => 'Reaction removed',
                'reactionCounts' => $reactionCounts,
                'userReaction' => null
            ]);
        }
        
        // If user has a different reaction, update it
        if ($existingReaction) {
            $logger->info('Updating existing reaction', [
                'commentaireId' => $commentaire->getId(),
                'oldType' => $existingReaction->getType(),
                'newType' => $type,
                'userId' => $user->getId()
            ]);
            
            $existingReaction->setType($type);
        } else {
            // Create new reaction
            $logger->info('Creating new reaction', [
                'commentaireId' => $commentaire->getId(),
                'reactionType' => $type,
                'userId' => $user->getId()
            ]);
            
            $reaction = new Reaction();
            $reaction->setCommentaire($commentaire);
            $reaction->setType($type);
            $reaction->setUser($user);
            $reaction->setCreatedAt(new \DateTime());
            
            $entityManager->persist($reaction);
        }
        
        $entityManager->flush();
        
        // Count reactions by type
        $reactionCounts = $this->countReactionsByType($commentaire->getReactions());
        $logger->info('Reaction counts after add/update', ['counts' => $reactionCounts]);
        
        return new JsonResponse([
            'success' => true,
            'message' => 'Reaction added',
            'reactionCounts' => $reactionCounts,
            'userReaction' => $type
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
