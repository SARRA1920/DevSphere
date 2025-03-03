<?php

namespace App\Controller\Api;

use App\Entity\BadWord;
use App\Service\ContentFilterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/content-filter')]
class ContentFilterController extends AbstractController
{
    private $contentFilter;
    private $entityManager;
    private $validator;

    public function __construct(
        ContentFilterService $contentFilter,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ) {
        $this->contentFilter = $contentFilter;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    #[Route('/analyze', name: 'api_content_analyze', methods: ['POST'])]
    public function analyze(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['text']) || empty($data['text'])) {
            return $this->json([
                'error' => 'Le champ text est requis'
            ], 400);
        }

        $result = $this->contentFilter->analyzeContent($data['text']);
        
        return $this->json($result);
    }

    #[Route('/filter', name: 'api_content_filter', methods: ['POST'])]
    public function filter(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['text']) || empty($data['text'])) {
            return $this->json([
                'error' => 'Le champ text est requis'
            ], 400);
        }

        $filteredText = $this->contentFilter->filterContent($data['text']);
        
        return $this->json([
            'original_text' => $data['text'],
            'filtered_text' => $filteredText
        ]);
    }

    #[Route('/suggest', name: 'api_content_suggest', methods: ['POST'])]
    public function suggest(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['text']) || empty($data['text'])) {
            return $this->json([
                'error' => 'Le champ text est requis'
            ], 400);
        }

        $suggestions = $this->contentFilter->suggestImprovements($data['text']);
        
        return $this->json($suggestions);
    }

    #[Route('/bad-words', name: 'api_bad_words_list', methods: ['GET'])]
    public function listBadWords(): JsonResponse
    {
        $badWords = $this->entityManager->getRepository(BadWord::class)->findAll();
        
        $result = array_map(function(BadWord $word) {
            return [
                'id' => $word->getId(),
                'word' => $word->getWord(),
                'severity' => $word->getSeverity(),
                'is_active' => $word->isActive()
            ];
        }, $badWords);
        
        return $this->json($result);
    }

    #[Route('/bad-words', name: 'api_bad_words_add', methods: ['POST'])]
    public function addBadWord(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['word']) || empty($data['word'])) {
            return $this->json([
                'error' => 'Le champ word est requis'
            ], 400);
        }

        $badWord = new BadWord();
        $badWord->setWord($data['word']);
        $badWord->setSeverity($data['severity'] ?? 5);
        $badWord->setIsActive(true);

        $errors = $this->validator->validate($badWord);
        if (count($errors) > 0) {
            return $this->json([
                'error' => (string) $errors
            ], 400);
        }

        $this->entityManager->persist($badWord);
        $this->entityManager->flush();

        return $this->json([
            'message' => 'Mot ajouté avec succès',
            'word' => [
                'id' => $badWord->getId(),
                'word' => $badWord->getWord(),
                'severity' => $badWord->getSeverity()
            ]
        ], 201);
    }

    #[Route('/bad-words/{id}', name: 'api_bad_words_delete', methods: ['DELETE'])]
    public function deleteBadWord(BadWord $badWord): JsonResponse
    {
        $this->entityManager->remove($badWord);
        $this->entityManager->flush();

        return $this->json([
            'message' => 'Mot supprimé avec succès'
        ]);
    }

    #[Route('/bad-words/{id}', name: 'api_bad_words_update', methods: ['PUT'])]
    public function updateBadWord(Request $request, BadWord $badWord): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['word'])) {
            $badWord->setWord($data['word']);
        }
        if (isset($data['severity'])) {
            $badWord->setSeverity($data['severity']);
        }
        if (isset($data['is_active'])) {
            $badWord->setIsActive($data['is_active']);
        }

        $errors = $this->validator->validate($badWord);
        if (count($errors) > 0) {
            return $this->json([
                'error' => (string) $errors
            ], 400);
        }

        $this->entityManager->flush();

        return $this->json([
            'message' => 'Mot mis à jour avec succès',
            'word' => [
                'id' => $badWord->getId(),
                'word' => $badWord->getWord(),
                'severity' => $badWord->getSeverity(),
                'is_active' => $badWord->isActive()
            ]
        ]);
    }

    #[Route('/test', name: 'api_content_filter_test', methods: ['GET'])]
    public function test(): JsonResponse
    {
        $testCases = [
            [
                'text' => 'Votre service est excellent !',
                'expected' => 'clean'
            ],
            [
                'text' => 'Ce service est nul, vous êtes incompétents !',
                'expected' => 'inappropriate'
            ],
            [
                'text' => 'Je suis très mécontent de votre service !',
                'expected' => 'clean'
            ],
            [
                'text' => 'Vous êtes tous des idiots !',
                'expected' => 'inappropriate'
            ]
        ];

        $results = [];
        foreach ($testCases as $test) {
            $analysis = $this->contentFilter->analyzeContent($test['text']);
            $results[] = [
                'text' => $test['text'],
                'expected' => $test['expected'],
                'result' => $analysis['is_inappropriate'] ? 'inappropriate' : 'clean',
                'found_words' => $analysis['found_words'] ?? [],
                'severity_score' => $analysis['severity_score'] ?? 0,
                'passed' => ($analysis['is_inappropriate'] ? 'inappropriate' : 'clean') === $test['expected']
            ];
        }

        return new JsonResponse([
            'test_results' => $results,
            'summary' => [
                'total_tests' => count($testCases),
                'passed_tests' => count(array_filter($results, fn($r) => $r['passed']))
            ]
        ]);
    }
}
