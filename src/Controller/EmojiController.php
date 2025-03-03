<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;
use App\Service\EmojiConverter;

class EmojiController extends AbstractController
{
    /**
     * Get all available emojis
     */
    #[Route('/api/emoji', name: 'app_emoji_all', methods: ['GET'])]
    public function getAllEmojis(LoggerInterface $logger): JsonResponse
    {
        $logger->info('Getting all emojis');
        
        $emojis = [
            'like' => [
                'emoji' => '👍',
                'label' => 'Like',
                'color' => '#1877f2'
            ],
            'love' => [
                'emoji' => '❤️',
                'label' => 'Love',
                'color' => '#e74c3c'
            ],
            'haha' => [
                'emoji' => '😂',
                'label' => 'Haha',
                'color' => '#f1c40f'
            ],
            'wow' => [
                'emoji' => '😮',
                'label' => 'Wow',
                'color' => '#f39c12'
            ],
            'sad' => [
                'emoji' => '😢',
                'label' => 'Sad',
                'color' => '#3498db'
            ],
            'angry' => [
                'emoji' => '😡',
                'label' => 'Angry',
                'color' => '#e74c3c'
            ]
        ];
        
        return new JsonResponse([
            'success' => true,
            'emojis' => $emojis
        ]);
    }
    
    /**
     * Get a specific emoji by type
     */
    #[Route('/api/emoji/{type}', name: 'app_emoji_get', methods: ['GET'])]
    public function getEmoji(string $type, LoggerInterface $logger): JsonResponse
    {
        $logger->info('Getting emoji', ['type' => $type]);
        
        $emojis = [
            'like' => [
                'emoji' => '👍',
                'label' => 'Like',
                'color' => '#1877f2'
            ],
            'love' => [
                'emoji' => '❤️',
                'label' => 'Love',
                'color' => '#e74c3c'
            ],
            'haha' => [
                'emoji' => '😂',
                'label' => 'Haha',
                'color' => '#f1c40f'
            ],
            'wow' => [
                'emoji' => '😮',
                'label' => 'Wow',
                'color' => '#f39c12'
            ],
            'sad' => [
                'emoji' => '😢',
                'label' => 'Sad',
                'color' => '#3498db'
            ],
            'angry' => [
                'emoji' => '😡',
                'label' => 'Angry',
                'color' => '#e74c3c'
            ]
        ];
        
        if (!isset($emojis[$type])) {
            $logger->warning('Emoji type not found', ['type' => $type]);
            return new JsonResponse([
                'success' => false,
                'error' => 'Emoji type not found'
            ], 404);
        }
        
        return new JsonResponse([
            'success' => true,
            'emoji' => $emojis[$type]
        ]);
    }
    
    /**
     * Get the emoji map for text conversion
     */
    #[Route('/api/emoji/map', name: 'app_emoji_map', methods: ['GET'])]
    public function getEmojiMap(EmojiConverter $emojiConverter, LoggerInterface $logger): JsonResponse
    {
        $logger->info('Getting emoji map');
        
        return new JsonResponse([
            'success' => true,
            'emojiMap' => $emojiConverter->getEmojiMap()
        ]);
    }
    
    /**
     * Convert text to emojis
     */
    #[Route('/api/emoji/convert', name: 'app_emoji_convert', methods: ['POST'])]
    public function convertToEmojis(Request $request, EmojiConverter $emojiConverter, LoggerInterface $logger): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $text = $content['text'] ?? '';
        
        $logger->info('Converting text to emojis', ['textLength' => strlen($text)]);
        
        if (empty($text)) {
            return new JsonResponse([
                'success' => false,
                'error' => 'No text provided'
            ], 400);
        }
        
        $convertedText = $emojiConverter->convertToEmojis($text);
        
        return new JsonResponse([
            'success' => true,
            'original' => $text,
            'converted' => $convertedText
        ]);
    }
}
