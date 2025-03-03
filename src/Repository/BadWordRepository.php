<?php

namespace App\Repository;

use App\Entity\BadWord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BadWord>
 */
class BadWordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BadWord::class);
    }

    /**
     * Récupère tous les mots inappropriés actifs
     */
    public function findAllActive(): array
    {
        return $this->createQueryBuilder('b')
            ->where('b.isActive = :active')
            ->setParameter('active', true)
            ->orderBy('b.severity', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche les mots inappropriés dans un texte
     */
    public function findBadWordsInText(string $text): array
    {
        $badWords = $this->findAllActive();
        $foundWords = [];
        $totalSeverity = 0;

        foreach ($badWords as $badWord) {
            if (stripos($text, $badWord->getWord()) !== false) {
                $foundWords[] = [
                    'word' => $badWord->getWord(),
                    'severity' => $badWord->getSeverity()
                ];
                $totalSeverity += $badWord->getSeverity();
            }
        }

        return [
            'found_words' => $foundWords,
            'total_severity' => $totalSeverity,
            'is_inappropriate' => count($foundWords) > 0
        ];
    }
}
