<?php
// This script tests the translation service directly

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/config/bootstrap.php';

use App\Service\TranslationService;
use Symfony\Component\HttpClient\HttpClient;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

$kernel = new \App\Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();
$container = $kernel->getContainer();

// Get services from the container
$translator = $container->get(TranslatorInterface::class);
$logger = $container->get(LoggerInterface::class);
$httpClient = HttpClient::create();

// Create translation service
$translationService = new TranslationService($httpClient, $logger, $translator);

// Test translations
$texts = [
    'hello',
    'welcome',
    'thank you',
    'This is a test message',
    'forum.title',
    'forum.post'
];

$targetLangs = ['fr', 'es', 'de'];

echo "Testing translations:\n\n";

foreach ($texts as $text) {
    echo "Original text: $text\n";
    
    foreach ($targetLangs as $lang) {
        $translated = $translationService->translate($text, $lang);
        echo "  - $lang: $translated\n";
    }
    
    echo "\n";
}

// Test Symfony translator directly
echo "Testing Symfony translator directly:\n\n";

foreach ($texts as $text) {
    echo "Original key: $text\n";
    
    foreach ($targetLangs as $lang) {
        // Try messages domain
        $translated = $translator->trans($text, [], 'messages', $lang);
        echo "  - $lang (messages): $translated\n";
        
        // Try forum domain
        $translated = $translator->trans($text, [], 'forum', $lang);
        echo "  - $lang (forum): $translated\n";
    }
    
    echo "\n";
}

echo "Done!\n";
