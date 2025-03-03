<?php

namespace App\Service;

use App\Repository\BadWordRepository;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Psr\Log\LoggerInterface;

class ContentFilterService
{
    private $cache;
    private $logger;
    private $badWordRepository;

    public function __construct(
        BadWordRepository $badWordRepository,
        LoggerInterface $logger
    ) {
        $this->badWordRepository = $badWordRepository;
        $this->logger = $logger;
        $this->cache = new FilesystemAdapter();
    }

    /**
     * Analyse un texte pour détecter les mots inappropriés
     */
    public function analyzeContent(string $text): array
    {
        $this->logger->info('Analyse du contenu démarrée', ['text_length' => strlen($text)]);

        // Utiliser le cache pour les résultats d'analyse
        $cacheKey = 'content_analysis_' . md5($text);
        
        return $this->cache->get($cacheKey, function() use ($text) {
            $result = $this->badWordRepository->findBadWordsInText($text);
            
            // Ajouter des métadonnées supplémentaires
            $result['text_length'] = strlen($text);
            $result['analysis_timestamp'] = time();
            
            // Calculer un score normalisé (0-100)
            if (!empty($result['found_words'])) {
                $maxPossibleSeverity = count($result['found_words']) * 10; // Supposons que 10 est la sévérité maximale
                $result['normalized_score'] = min(100, ($result['total_severity'] / $maxPossibleSeverity) * 100);
            } else {
                $result['normalized_score'] = 0;
            }

            $this->logger->info('Analyse terminée', $result);
            
            return $result;
        });
    }

    /**
     * Masque les mots inappropriés dans un texte
     */
    public function filterContent(string $text): string
    {
        $analysis = $this->analyzeContent($text);
        
        if (empty($analysis['found_words'])) {
            return $text;
        }

        $filteredText = $text;
        foreach ($analysis['found_words'] as $badWord) {
            $replacement = str_repeat('*', strlen($badWord['word']));
            $filteredText = str_ireplace($badWord['word'], $replacement, $filteredText);
        }

        return $filteredText;
    }

    /**
     * Suggère des améliorations pour le texte
     */
    public function suggestImprovements(string $text): array
    {
        $analysis = $this->analyzeContent($text);
        $suggestions = [];

        if (!empty($analysis['found_words'])) {
            foreach ($analysis['found_words'] as $badWord) {
                $suggestions[] = [
                    'original' => $badWord['word'],
                    'suggestion' => 'Considérez utiliser un langage plus approprié',
                    'severity' => $badWord['severity']
                ];
            }
        }

        return [
            'has_suggestions' => !empty($suggestions),
            'suggestions' => $suggestions,
            'overall_score' => $analysis['normalized_score'] ?? 0
        ];
    }
}
