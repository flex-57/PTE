<?php

namespace App\Repository;

use App\Entity\Atelier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AtelierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Atelier::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.domaine', 'd')->addSelect('d')
            ->leftJoin('a.criteres', 'c')->addSelect('c')
            ->orderBy('a.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

     public function searchDeep(string $query): array
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.domaine', 'd')->addSelect('d')
            ->leftJoin('a.criteres', 'c')->addSelect('c')
            ->where('a.nom LIKE :q OR d.nom LIKE :q OR c.nom LIKE :q')
            ->setParameter('q', '%' . $query . '%')
            ->orderBy('a.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
