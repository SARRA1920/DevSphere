<?php
// This is a simple test script to debug the translation service

require dirname(__DIR__).'/vendor/autoload.php';

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Request;

$kernel = new Kernel($_SERVER['APP_ENV'] ?? 'dev', (bool) ($_SERVER['APP_DEBUG'] ?? true));
$kernel->boot();
$container = $kernel->getContainer();

// Get the translator service
$translator = $container->get('translator');
$translationService = $container->get('App\Service\TranslationService');

// Test words
$words = [
    'welcome',
    'hello',
    'thank_you',
    'forum.title',
    'forum.post'
];

$languages = ['en', 'fr', 'es', 'de'];

echo "<h1>Translation Test</h1>";

// Test the translator service
echo "<h2>Testing Symfony Translator</h2>";
echo "<table border='1'>";
echo "<tr><th>Key</th><th>Domain</th>";
foreach ($languages as $lang) {
    echo "<th>$lang</th>";
}
echo "</tr>";

foreach ($words as $word) {
    // Messages domain
    echo "<tr>";
    echo "<td>$word</td>";
    echo "<td>messages</td>";
    
    foreach ($languages as $lang) {
        $translated = $translator->trans($word, [], 'messages', $lang);
        echo "<td>$translated</td>";
    }
    
    echo "</tr>";
    
    // Forum domain
    echo "<tr>";
    echo "<td>$word</td>";
    echo "<td>forum</td>";
    
    foreach ($languages as $lang) {
        $translated = $translator->trans($word, [], 'forum', $lang);
        echo "<td>$translated</td>";
    }
    
    echo "</tr>";
}

echo "</table>";

// Test the translation service
echo "<h2>Testing TranslationService</h2>";
echo "<table border='1'>";
echo "<tr><th>Text</th>";
foreach ($languages as $lang) {
    echo "<th>$lang</th>";
}
echo "</tr>";

foreach ($words as $word) {
    echo "<tr>";
    echo "<td>$word</td>";
    
    foreach ($languages as $lang) {
        try {
            $translated = $translationService->translate($word, $lang);
            echo "<td>$translated</td>";
        } catch (\Exception $e) {
            echo "<td>Error: " . htmlspecialchars($e->getMessage()) . "</td>";
        }
    }
    
    echo "</tr>";
}

echo "</table>";

// Show translation files
echo "<h2>Translation Files</h2>";
$translationsDir = dirname(__DIR__) . '/translations';
$files = scandir($translationsDir);

echo "<ul>";
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        echo "<li>$file</li>";
    }
}
echo "</ul>";

// Show translation configuration
echo "<h2>Translation Configuration</h2>";
echo "<ul>";
echo "<li>Default locale: " . $container->getParameter('kernel.default_locale') . "</li>";

if ($container->hasParameter('translator.default_path')) {
    echo "<li>Translator default path: " . $container->getParameter('translator.default_path') . "</li>";
} else {
    echo "<li>No translator.default_path parameter found</li>";
}

if ($container->hasParameter('translator.paths')) {
    echo "<li>Translator paths: " . json_encode($container->getParameter('translator.paths')) . "</li>";
} else {
    echo "<li>No translator.paths parameter found</li>";
}
echo "</ul>";
