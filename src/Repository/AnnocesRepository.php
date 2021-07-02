<?php

namespace App\Repository;

use App\Entity\Annoces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Annoces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annoces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annoces[]    findAll()
 * @method Annoces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnocesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annoces::class);
    }

    // /**
    //  * @return Annoces[] Returns an array of Annoces objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Annoces
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
