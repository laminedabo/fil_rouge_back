<?php

namespace App\Repository;

use App\Entity\Groupetag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Groupetag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Groupetag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Groupetag[]    findAll()
 * @method Groupetag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupetagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupetag::class);
    }

    // /**
    //  * @return Groupetag[] Returns an array of Groupetag objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Groupetag
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
