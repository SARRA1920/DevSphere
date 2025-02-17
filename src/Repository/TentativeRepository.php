<?php

namespace App\Repository;

use App\Entity\Tentative;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tentative>
 *
 * @method Tentative|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tentative|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tentative[]    findAll()
 * @method Tentative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TentativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tentative::class);
    }

    public function countSuccessfulTentatives(): int
    {
        $qb = $this->createQueryBuilder('t')
            ->select('COUNT(t.id)')
            ->join('t.exercice', 'e')
            ->where('t.score >= e.noteMinimale');

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    public function getAverageScore(?User $user = null): float
    {
        $qb = $this->createQueryBuilder('t')
            ->select('AVG(t.score)');

        if ($user) {
            $qb->where('t.user = :user')
               ->setParameter('user', $user);
        }

        $result = $qb->getQuery()->getSingleScalarResult();
        return $result ? round($result, 2) : 0.0;
    }

    public function findLatestTentatives(int $limit = 10): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.date', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findSuccessfulTentatives(): array
    {
        return $this->createQueryBuilder('t')
            ->join('t.exercice', 'e')
            ->where('t.score >= e.noteMinimale')
            ->getQuery()
            ->getResult();
    }
}
