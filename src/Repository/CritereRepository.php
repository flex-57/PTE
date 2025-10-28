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

    public function findAll(): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.metiers', 'm')->addSelect('m')
            ->leftJoin('c.ateliers', 'a')->addSelect('a')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

     public function searchDeep(string $query): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.metiers', 'm')->addSelect('m')
            ->leftJoin('c.ateliers', 'a')->addSelect('a')
            ->where('c.nom LIKE :q OR m.nom LIKE :q OR a.nom LIKE :q')
            ->setParameter('q', '%' . $query . '%')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
