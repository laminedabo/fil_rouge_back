<?php

namespace App\Repository;

use App\Entity\BriefLivrableAttendu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BriefLivrableAttendu|null find($id, $lockMode = null, $lockVersion = null)
 * @method BriefLivrableAttendu|null findOneBy(array $criteria, array $orderBy = null)
 * @method BriefLivrableAttendu[]    findAll()
 * @method BriefLivrableAttendu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BriefLivrableAttenduRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BriefLivrableAttendu::class);
    }

    // /**
    //  * @return BriefLivrableAttendu[] Returns an array of BriefLivrableAttendu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BriefLivrableAttendu
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
