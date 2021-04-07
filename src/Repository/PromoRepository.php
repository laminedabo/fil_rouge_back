<?php

namespace App\Repository;

use App\Entity\Promo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Promo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promo[]    findAll()
 * @method Promo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promo::class);
    }

    // /**
    //  * @return Promo[] Returns an array of Promo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Promo
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
    * @return Promo Returns one Promo object with unucally its principal group
    */
    public function findGroupePrincipal($id_promo): ?Promo
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $id_promo)
            ->leftJoin('p.groupes','g')
            ->andWhere('g.type = :type')
            ->setParameter('type', "principal")
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
    * @return Promo[] Returns an array of Promo objects with unucally their principal group
    */
    public function findGroupesPrincipaux()
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.groupes','g')
            ->andWhere('g.type = :type')
            ->setParameter('type', "principal")
            ->getQuery()
            ->getResult()
        ;
    }
}
