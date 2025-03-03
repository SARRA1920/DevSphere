<?php

namespace App\Repository;

use App\Entity\Publication;
use App\Enum\PublicationCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Publication>
 */
class PublicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publication::class);
    }

    /**
     * Search publications by keyword and/or category
     * 
     * @param string|null $keyword Search keyword
     * @param string|null $category Category value (like "Web Development")
     * @return Publication[] Returns an array of Publication objects
     */
    public function searchPublications(?string $keyword = null, $category = null): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->orderBy('p.date', 'DESC');
        
        // Add keyword search condition if provided
        if ($keyword) {
            $qb->andWhere('p.titre LIKE :keyword OR p.contenu LIKE :keyword')
               ->setParameter('keyword', '%' . $keyword . '%');
        }
        
        // Add category filter if provided
        if ($category) {
            // We need to convert the category value (e.g., "Web Development") to the actual enum
            try {
                // Try to find the enum by value
                $enumValue = null;
                
                // Get all enum cases and find the one with the matching value
                foreach (PublicationCategory::cases() as $case) {
                    if ($case->value === $category) {
                        $enumValue = $case;
                        break;
                    }
                }
                
                if ($enumValue) {
                    $qb->andWhere('c.category = :category')
                       ->setParameter('category', $enumValue);
                }
            } catch (\Exception $e) {
                // If there's an error, just continue without filtering by category
            }
        }
        
        return $qb->getQuery()->getResult();
    }

    /**
     * Get all available categories with publication counts
     * 
     * @return array Array of categories with counts
     */
    public function getCategoriesWithCount(): array
    {
        $qb = $this->createQueryBuilder('p')
            ->select('c.category as category, COUNT(p.id) as count')
            ->leftJoin('p.category', 'c')
            ->groupBy('c.category')
            ->orderBy('count', 'DESC');
        
        return $qb->getQuery()->getResult();
    }
}
