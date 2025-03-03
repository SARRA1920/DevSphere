<?php

namespace App\Controller;

use App\Service\TranslationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Psr\Log\LoggerInterface;

class TranslationTestController extends AbstractController
{
    #[Route('/translation/test', name: 'app_translation_test')]
    public function index(Request $request, TranslatorInterface $translator, TranslationService $translationService, LoggerInterface $logger): Response
    {
        // Get locale from request or use default
        $locale = $request->query->get('locale', 'fr');
        $logger->info('Translation test page accessed', ['locale' => $locale]);
        
        // Test translations using Symfony's translator
        $translatedWelcome = $translator->trans('welcome', [], 'messages', $locale);
        $logger->info('Translated welcome', ['original' => 'welcome', 'translated' => $translatedWelcome, 'locale' => $locale]);
        
        $translatedForumTitle = $translator->trans('forum.title', [], 'forum', $locale);
        $logger->info('Translated forum title', ['original' => 'forum.title', 'translated' => $translatedForumTitle, 'locale' => $locale]);
        
        // Test translations using our TranslationService
        $customText = "Hello, this is a test message.";
        $translatedCustomText = $translationService->translate($customText, $locale);
        $logger->info('Translated custom text', ['original' => $customText, 'translated' => $translatedCustomText, 'locale' => $locale]);
        
        // Test some common words that should be in our translation files
        $testWords = [
            'welcome' => $translator->trans('welcome', [], 'messages', $locale),
            'forum.title' => $translator->trans('forum.title', [], 'forum', $locale),
            'forum.post' => $translator->trans('forum.post', [], 'forum', $locale),
            'forum.comment_label' => $translator->trans('forum.comment_label', [], 'forum', $locale),
            'forum.translate' => $translator->trans('forum.translate', [], 'forum', $locale),
        ];
        
        // Get available locales from the translator
        $locales = [];
        try {
            // This is a hack to get the available locales from the translator
            // It might not work depending on the translator implementation
            $reflection = new \ReflectionObject($translator);
            if ($reflection->hasProperty('catalogues')) {
                $cataloguesProperty = $reflection->getProperty('catalogues');
                $cataloguesProperty->setAccessible(true);
                $catalogues = $cataloguesProperty->getValue($translator);
                $locales = array_keys($catalogues);
            }
        } catch (\Exception $e) {
            $logger->error('Error getting locales', ['error' => $e->getMessage()]);
        }
        
        return $this->render('translation_test/index.html.twig', [
            'locale' => $locale,
            'translatedWelcome' => $translatedWelcome,
            'translatedForumTitle' => $translatedForumTitle,
            'originalText' => $customText,
            'translatedCustomText' => $translatedCustomText,
            'supportedLanguages' => $translationService->getSupportedLanguages(),
            'availableLocales' => $locales,
            'testWords' => $testWords,
        ]);
    }
    
    #[Route('/translation/test/direct', name: 'app_translation_test_direct')]
    public function testDirect(Request $request, TranslationService $translationService, LoggerInterface $logger): Response
    {
        $text = $request->query->get('text', 'welcome');
        $targetLang = $request->query->get('lang', 'fr');
        
        $logger->info('Testing direct translation', [
            'text' => $text,
            'targetLang' => $targetLang
        ]);
        
        $translated = $translationService->translate($text, $targetLang);
        
        return new Response(json_encode([
            'original' => $text,
            'translated' => $translated,
            'targetLang' => $targetLang
        ]), 200, ['Content-Type' => 'application/json']);
    }
    
    #[Route('/translation/test/simple', name: 'app_translation_test_simple')]
    public function testSimple(Request $request, TranslatorInterface $translator, LoggerInterface $logger): Response
    {
        $locale = $request->query->get('locale', 'fr');
        $text = $request->query->get('text', 'welcome');
        
        $logger->info('Simple translation test', [
            'text' => $text,
            'locale' => $locale
        ]);
        
        // Test translations using Symfony's translator
        $result = [];
        
        // Try messages domain
        $result['messages'] = $translator->trans($text, [], 'messages', $locale);
        $logger->info('Translated in messages domain', [
            'original' => $text,
            'translated' => $result['messages'],
            'locale' => $locale
        ]);
        
        // Try forum domain
        $result['forum'] = $translator->trans($text, [], 'forum', $locale);
        $logger->info('Translated in forum domain', [
            'original' => $text,
            'translated' => $result['forum'],
            'locale' => $locale
        ]);
        
        return new Response(json_encode($result), 200, ['Content-Type' => 'application/json']);
    }
    
    #[Route('/translation/test/page', name: 'app_translation_test_page')]
    public function testPage(Request $request, TranslatorInterface $translator, LoggerInterface $logger): Response
    {
        $locale = $request->query->get('locale', 'fr');
        $text = $request->query->get('text', 'welcome');
        
        $logger->info('Translation test page', [
            'text' => $text,
            'locale' => $locale
        ]);
        
        // Get available locales
        $locales = ['en', 'fr', 'es', 'de'];
        
        // Test words
        $words = [
            'welcome',
            'hello',
            'thank_you',
            'forum.title',
            'forum.post',
            'forum.welcome_message',
            'forum.comment_label'
        ];
        
        // Test translations
        $translations = [];
        foreach ($words as $word) {
            $translations[$word] = [];
            foreach ($locales as $loc) {
                // Try messages domain
                $translations[$word][$loc]['messages'] = $translator->trans($word, [], 'messages', $loc);
                
                // Try forum domain
                $translations[$word][$loc]['forum'] = $translator->trans($word, [], 'forum', $loc);
            }
        }
        
        // Get translation files
        $projectDir = $this->getParameter('kernel.project_dir');
        $translationsDir = $projectDir . '/translations';
        $files = [];
        
        if (is_dir($translationsDir)) {
            foreach (scandir($translationsDir) as $file) {
                if ($file !== '.' && $file !== '..') {
                    $files[] = $file;
                }
            }
        }
        
        return $this->render('translation/test_page.html.twig', [
            'locale' => $locale,
            'text' => $text,
            'locales' => $locales,
            'words' => $words,
            'translations' => $translations,
            'files' => $files
        ]);
    }
}
