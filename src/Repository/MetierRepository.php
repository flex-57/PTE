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

    public function CreateQuery(): \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.domaine', 'd')->addSelect('d')
            ->leftJoin('m.criteres', 'c')->addSelect('c')
            ->leftJoin('d.ateliers', 'a')->addSelect('a')
            ->leftJoin('a.criteres', 'ac')->addSelect('ac');
    }

    public function find2(int $id): ?Metier
    {
        return $this->CreateQuery()
            ->leftJoin('c.metiers', 'mc')->addSelect('mc')
            ->leftJoin('c.ateliers', 'ca')->addSelect('ca')
            ->where('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAll(): array
    {
        return $this->CreateQuery()
            ->orderBy('m.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

     public function searchDeep(string $query): array
    {
        return $this->CreateQuery()
            ->where('m.nom LIKE :q OR d.nom LIKE :q OR c.nom LIKE :q')
            ->setParameter('q', '%' . $query . '%')
            ->orderBy('m.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
