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

    public function CreateQuery(): \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.domaine', 'd')->addSelect('d')
            ->leftJoin('a.criteres', 'c')->addSelect('c')
            ->leftJoin('d.metiers', 'm')->addSelect('m')
            ->leftJoin('m.criteres', 'mc')->addSelect('mc');
    }

    public function find2(int $id): ?Atelier
    {
        return $this->CreateQuery()
            ->leftJoin('c.metiers', 'cm')->addSelect('cm')
            ->leftJoin('c.ateliers', 'ca')->addSelect('ca')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAll(): array
    {
        return $this->CreateQuery()
            ->orderBy('a.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

     public function searchDeep(string $query): array
    {
        return $this->CreateQuery()
            ->where('a.nom LIKE :q OR d.nom LIKE :q OR c.nom LIKE :q')
            ->setParameter('q', '%' . $query . '%')
            ->orderBy('a.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
