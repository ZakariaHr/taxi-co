<?php

namespace App\Repository;


use App\Entity\Driver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DriverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Driver::class);
    }

    public function getDrivers()
    {
        $qb = $this->createQueryBuilder('d')
            ->select('d.name, d.surname, d.type');

        return $qb->getQuery()->getResult();
    }
}