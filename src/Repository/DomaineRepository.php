<?php

namespace App\Repository;

use App\Entity\Domaine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DomaineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Domaine::class);
    }

    public function CreateQuery(): \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.metiers', 'm')->addSelect('m')
            ->leftJoin('d.ateliers', 'a')->addSelect('a')
            ->leftJoin('m.criteres', 'mc')->addSelect('mc')
            ->leftJoin('a.criteres', 'ac')->addSelect('ac');
    }

    public function find2(int $id): ?Domaine
    {
        return $this->CreateQuery()
            ->where('d.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAll(): array
    {
        return $this->CreateQuery()
            ->orderBy('d.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function searchDeep(string $query): array
    {
        return $this->CreateQuery()
            ->where('d.nom LIKE :q OR m.nom LIKE :q OR a.nom LIKE :q')
            ->setParameter('q', '%' . $query . '%')
            ->orderBy('d.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
