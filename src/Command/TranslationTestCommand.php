<?php

namespace App\Command;

use App\Service\TranslationService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsCommand(
    name: 'app:test-translation',
    description: 'Test the translation service',
)]
class TranslationTestCommand extends Command
{
    private TranslationService $translationService;
    private TranslatorInterface $translator;

    public function __construct(TranslationService $translationService, TranslatorInterface $translator)
    {
        parent::__construct();
        $this->translationService = $translationService;
        $this->translator = $translator;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('text', InputArgument::OPTIONAL, 'Text to translate', 'hello')
            ->addOption('lang', 'l', InputOption::VALUE_OPTIONAL, 'Target language', 'fr')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $text = $input->getArgument('text');
        $lang = $input->getOption('lang');

        $io->title('Translation Test');
        $io->writeln("Testing translation of '$text' to '$lang'");
        
        // Dump the translator service to see what we're working with
        $io->section('Translator Service Information');
        $io->writeln("Translator class: " . get_class($this->translator));
        
        // Test the simulated translations directly
        $io->section('Testing Simulated Translations');
        try {
            $reflection = new \ReflectionObject($this->translationService);
            $simulatedTranslationsProperty = $reflection->getProperty('simulatedTranslations');
            $simulatedTranslationsProperty->setAccessible(true);
            $simulatedTranslations = $simulatedTranslationsProperty->getValue($this->translationService);
            
            $io->writeln("Available simulated translations:");
            foreach ($simulatedTranslations as $key => $translations) {
                $io->writeln("- '$key': " . json_encode($translations));
            }
            
            // Check if our test word is in the simulated translations
            $lowerText = strtolower(trim($text));
            if (isset($simulatedTranslations[$lowerText][$lang])) {
                $io->writeln("Found simulated translation for '$lowerText' in '$lang': " . $simulatedTranslations[$lowerText][$lang]);
            } else {
                $io->writeln("No simulated translation found for '$lowerText' in '$lang'");
            }
        } catch (\Exception $e) {
            $io->error("Error accessing simulated translations: " . $e->getMessage());
        }
        
        // Test TranslationService
        $io->section('Testing TranslationService');
        try {
            $translated = $this->translationService->translate($text, $lang);
            $io->success("Translated '$text' to '$translated' ($lang)");
        } catch (\Exception $e) {
            $io->error("Translation failed: " . $e->getMessage());
            $io->writeln($e->getTraceAsString());
        }
        
        // Test Symfony Translator
        $io->section('Testing Symfony Translator directly');
        
        try {
            // Try messages domain
            $translatedMessages = $this->translator->trans($text, [], 'messages', $lang);
            $io->writeln("Messages domain: '$translatedMessages'");
            
            // Try forum domain
            $translatedForum = $this->translator->trans($text, [], 'forum', $lang);
            $io->writeln("Forum domain: '$translatedForum'");
        } catch (\Exception $e) {
            $io->error("Symfony translator failed: " . $e->getMessage());
            $io->writeln($e->getTraceAsString());
        }
        
        // Test some common words
        $io->section('Testing common words');
        $words = ['welcome', 'hello', 'thank_you', 'forum.title', 'forum.post'];
        
        foreach ($words as $word) {
            try {
                $translatedWord = $this->translator->trans($word, [], 'messages', $lang);
                $io->writeln("'$word' -> '$translatedWord' (messages domain)");
                
                $translatedWord = $this->translator->trans($word, [], 'forum', $lang);
                $io->writeln("'$word' -> '$translatedWord' (forum domain)");
            } catch (\Exception $e) {
                $io->error("Translation of '$word' failed: " . $e->getMessage());
            }
        }
        
        // Get supported languages
        $io->section('Supported Languages');
        try {
            $languages = $this->translationService->getSupportedLanguages();
            foreach ($languages as $code => $name) {
                $io->writeln("$code: $name");
            }
        } catch (\Exception $e) {
            $io->error("Error getting supported languages: " . $e->getMessage());
        }
        
        // Check translation files
        $io->section('Translation Files');
        $projectDir = $this->getApplication()->getKernel()->getProjectDir();
        $translationsDir = $projectDir . '/translations';
        
        $io->writeln("Translations directory: $translationsDir");
        
        if (is_dir($translationsDir)) {
            $files = scandir($translationsDir);
            $io->writeln("Translation files found:");
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $io->writeln("- $file");
                    
                    // Check file contents
                    $filePath = $translationsDir . '/' . $file;
                    if (is_file($filePath) && is_readable($filePath)) {
                        $content = file_get_contents($filePath);
                        $io->writeln("  Content: " . substr($content, 0, 100) . (strlen($content) > 100 ? '...' : ''));
                    } else {
                        $io->writeln("  Cannot read file");
                    }
                }
            }
        } else {
            $io->error("Translations directory not found!");
        }
        
        // Check translation configuration
        $io->section('Translation Configuration');
        try {
            $kernel = $this->getApplication()->getKernel();
            $container = $kernel->getContainer();
            
            $io->writeln("Default locale: " . $container->getParameter('kernel.default_locale'));
            
            if ($container->hasParameter('translator.default_path')) {
                $io->writeln("Translator default path: " . $container->getParameter('translator.default_path'));
            } else {
                $io->writeln("No translator.default_path parameter found");
            }
            
            if ($container->hasParameter('translator.paths')) {
                $io->writeln("Translator paths: " . json_encode($container->getParameter('translator.paths')));
            } else {
                $io->writeln("No translator.paths parameter found");
            }
        } catch (\Exception $e) {
            $io->error("Error getting translation configuration: " . $e->getMessage());
        }

        return Command::SUCCESS;
    }
}
