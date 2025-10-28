<?php

namespace App\Repository;

use App\Entity\Critere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CritereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Critere::class);
    }

     public function searchDeep(string $query): array
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.nom LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->getQuery()
            ->getResult();

        return $qb;
    }
}
