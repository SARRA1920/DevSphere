<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\Commentaire;
use App\Service\TranslationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;

class TranslationController extends AbstractController
{
    /**
     * Get supported languages
     */
    #[Route('/api/translation/languages', name: 'app_translation_languages', methods: ['GET'])]
    public function getSupportedLanguages(TranslationService $translationService, LoggerInterface $logger): JsonResponse
    {
        $logger->info('Getting supported languages');
        
        return new JsonResponse([
            'success' => true,
            'languages' => $translationService->getSupportedLanguages()
        ]);
    }
    
    /**
     * Translate a text
     */
    #[Route('/api/translation/translate', name: 'app_translation_text', methods: ['POST'])]
    public function translateText(Request $request, TranslationService $translationService, LoggerInterface $logger): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $text = $content['text'] ?? '';
        $targetLang = $content['targetLang'] ?? 'en';
        $sourceLang = $content['sourceLang'] ?? 'auto';
        
        $logger->info('Translating text', [
            'textLength' => strlen($text),
            'sourceLang' => $sourceLang,
            'targetLang' => $targetLang
        ]);
        
        if (empty($text)) {
            return new JsonResponse([
                'success' => false,
                'error' => 'No text provided'
            ], 400);
        }
        
        $translatedText = $translationService->translate($text, $targetLang, $sourceLang);
        
        return new JsonResponse([
            'success' => true,
            'original' => $text,
            'translated' => $translatedText,
            'sourceLang' => $sourceLang,
            'targetLang' => $targetLang
        ]);
    }
    
    /**
     * Translate a publication
     */
    #[Route('/api/translation/publication/{id}/{targetLang}', name: 'app_translation_publication', methods: ['GET'])]
    public function translatePublication(
        Publication $publication, 
        string $targetLang, 
        TranslationService $translationService, 
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('Translating publication', [
            'id' => $publication->getId(),
            'targetLang' => $targetLang,
            'title' => $publication->getTitre(),
            'content' => $publication->getContenu()
        ]);
        
        try {
            $translatedTitle = $translationService->translate($publication->getTitre(), $targetLang);
            $translatedContent = $translationService->translate($publication->getContenu(), $targetLang);
            
            $logger->info('Publication translated successfully', [
                'originalTitle' => $publication->getTitre(),
                'translatedTitle' => $translatedTitle,
                'originalContent' => $publication->getContenu(),
                'translatedContent' => $translatedContent
            ]);
            
            return new JsonResponse([
                'success' => true,
                'publication' => [
                    'id' => $publication->getId(),
                    'original' => [
                        'title' => $publication->getTitre(),
                        'content' => $publication->getContenu()
                    ],
                    'translated' => [
                        'title' => $translatedTitle,
                        'content' => $translatedContent
                    ],
                    'targetLang' => $targetLang
                ]
            ]);
        } catch (\Exception $e) {
            $logger->error('Error translating publication', [
                'id' => $publication->getId(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return new JsonResponse([
                'success' => false,
                'error' => 'Translation failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Translate a comment
     */
    #[Route('/api/translation/comment/{id}/{targetLang}', name: 'app_translation_comment', methods: ['GET'])]
    public function translateComment(
        Commentaire $comment, 
        string $targetLang, 
        TranslationService $translationService, 
        LoggerInterface $logger,
        Request $request
    ): JsonResponse {
        $logger->info('Translating comment', [
            'id' => $comment->getId(),
            'targetLang' => $targetLang,
            'content' => $comment->getContenu(),
            'requestPath' => $request->getPathInfo(),
            'requestMethod' => $request->getMethod()
        ]);
        
        try {
            $translatedContent = $translationService->translate($comment->getContenu(), $targetLang);
            
            $logger->info('Comment translated successfully', [
                'originalContent' => $comment->getContenu(),
                'translatedContent' => $translatedContent,
                'commentId' => $comment->getId()
            ]);
            
            return new JsonResponse([
                'success' => true,
                'comment' => [
                    'id' => $comment->getId(),
                    'original' => [
                        'content' => $comment->getContenu()
                    ],
                    'translated' => [
                        'content' => $translatedContent
                    ],
                    'targetLang' => $targetLang
                ]
            ]);
        } catch (\Exception $e) {
            $logger->error('Error translating comment', [
                'id' => $comment->getId(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return new JsonResponse([
                'success' => false,
                'error' => 'Translation failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Detect language of a text
     */
    #[Route('/api/translation/detect', name: 'app_translation_detect', methods: ['POST'])]
    public function detectLanguage(Request $request, TranslationService $translationService, LoggerInterface $logger): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $text = $content['text'] ?? '';
        
        $logger->info('Detecting language', [
            'textLength' => strlen($text)
        ]);
        
        if (empty($text)) {
            return new JsonResponse([
                'success' => false,
                'error' => 'No text provided'
            ], 400);
        }
        
        $detectedLang = $translationService->detectLanguage($text);
        
        return new JsonResponse([
            'success' => true,
            'text' => $text,
            'detectedLanguage' => $detectedLang
        ]);
    }
}
