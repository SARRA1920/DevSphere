<?php

namespace App\Repository;

use App\Entity\Reclamation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @extends ServiceEntityRepository<Reclamation>
 */
class ReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamation::class);
    }

    public function findBySearch(?string $query): array
    {
        if (empty($query)) {
            return $this->findBy([], ['date' => 'DESC']);
        }

        $qb = $this->createQueryBuilder('r')
            ->leftJoin('r.user', 'u')
            ->where('r.type LIKE :query')
            ->orWhere('r.reclamation LIKE :query')
            ->orWhere('u.email LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('r.date', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function getStatsByType(): array
    {
        return $this->createQueryBuilder('r')
            ->select('r.type, COUNT(r.id) as count')
            ->groupBy('r.type')
            ->getQuery()
            ->getResult();
    }
}
