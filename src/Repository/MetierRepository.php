<?php

namespace App\Repository;

use App\Entity\Metier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MetierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Metier::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.domaine', 'd')->addSelect('d')
            ->leftJoin('m.criteres', 'c')->addSelect('c')
            ->orderBy('m.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

     public function searchDeep(string $query): array
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.domaine', 'd')->addSelect('d')
            ->leftJoin('m.criteres', 'c')->addSelect('c')
            ->where('m.nom LIKE :q OR d.nom LIKE :q OR c.nom LIKE :q')
            ->setParameter('q', '%' . $query . '%')
            ->orderBy('m.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
