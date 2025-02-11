<?php

namespace App\Repository;

use App\Entity\Sport;
use App\Entity\Tournament;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TournamentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tournament::class);
    }

    public function findWithFilter(?Sport $sport) {
        $qb = $this->createQueryBuilder('t')
            ->leftJoin('t.sport', 's');

        if ($sport !== null) {
            $qb->where('s.id = :sport')
                ->setParameter('sport', $sport->getId());
        }

        return $qb->getQuery()->getResult();
    }
}