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

    public function CreateQuery(): \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.metiers', 'm')->addSelect('m')
            ->leftJoin('c.ateliers', 'a')->addSelect('a')
            ->leftJoin('m.criteres', 'mc')->addSelect('mc')
            ->leftJoin('a.criteres', 'ac')->addSelect('ac');
    }

    public function find2(int $id): ?Critere
    {
        return $this->CreateQuery()

            ->leftJoin('m.domaine', 'd')->addSelect('d')
            ->leftJoin('a.domaine', 'ad')->addSelect('ad')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAll(): array
    {
        return $this->CreateQuery()
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

     public function searchDeep(string $query): array
    {
        return $this->CreateQuery()
            ->where('c.nom LIKE :q OR m.nom LIKE :q OR a.nom LIKE :q')
            ->setParameter('q', '%' . $query . '%')
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
