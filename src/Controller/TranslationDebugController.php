<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Psr\Log\LoggerInterface;
use App\Service\TranslationService;

class TranslationDebugController extends AbstractController
{
    private $translator;
    private $logger;
    private $translationService;
    
    public function __construct(
        TranslatorInterface $translator,
        LoggerInterface $logger,
        TranslationService $translationService
    ) {
        $this->translator = $translator;
        $this->logger = $logger;
        $this->translationService = $translationService;
    }
    
    #[Route('/debug/translation', name: 'app_debug_translation')]
    public function index(Request $request): Response
    {
        $text = $request->query->get('text', 'hello');
        $locale = $request->query->get('locale', 'fr');
        
        // Get translation files
        $translationsDir = $this->getParameter('kernel.project_dir') . '/translations';
        $files = [];
        
        if (is_dir($translationsDir)) {
            foreach (scandir($translationsDir) as $file) {
                if ($file !== '.' && $file !== '..') {
                    $files[] = $file;
                }
            }
        }
        
        // Test translator
        $messagesTranslation = $this->translator->trans($text, [], 'messages', $locale);
        $forumTranslation = $this->translator->trans($text, [], 'forum', $locale);
        
        // Test service
        try {
            $serviceTranslation = $this->translationService->translate($text, $locale);
        } catch (\Exception $e) {
            $serviceTranslation = 'Error: ' . $e->getMessage();
        }
        
        // Test common words
        $words = ['welcome', 'hello', 'thank_you', 'forum.title', 'forum.post'];
        $translations = [];
        
        foreach ($words as $word) {
            $translations[$word] = [
                'messages' => $this->translator->trans($word, [], 'messages', $locale),
                'forum' => $this->translator->trans($word, [], 'forum', $locale)
            ];
        }
        
        // Get supported languages
        $languages = $this->translationService->getSupportedLanguages();
        
        return $this->json([
            'text' => $text,
            'locale' => $locale,
            'files' => $files,
            'translations' => [
                'messages' => $messagesTranslation,
                'forum' => $forumTranslation,
                'service' => $serviceTranslation
            ],
            'common_words' => $translations,
            'languages' => $languages
        ]);
    }
}
