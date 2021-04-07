<?php

namespace App\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByProfil($value)
    {
        return $this->createQueryBuilder('u')
        ->innerJoin('u.profil', 'p')
        ->andWhere('p.libelle = :val')
        ->setParameter('val', $value)
        ->orderBy('u.id', 'ASC')
        ->getQuery()
        ->getResult()
        ;
    }
    public function findByEmail($value)
    {
        return $this->createQueryBuilder('u')
        ->Where('u.email = :val')
        ->setParameter('val', $value)
        ->orderBy('u.id', 'ASC')
        ->getQuery()
        ->getResult()
        ;
    }

    public function findOneByEmail($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->Where('u.email = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findOneByUsername($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->Where('u.username = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getCount(){
        return $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->andWhere('u.statut= :st')
            ->setParameter('st','actif')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getCountByProfil($profil_id){
        return $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->andWhere('u.statut= :st')
            ->setParameter('st','actif')
            ->andWhere('u.profil_id= :profil_id')//probleme à ce niveau
            ->setParameter('profil_id',$profil_id)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function searchTerm($term){
        return $this->createQueryBuilder('u')
        ->Where('u.nom like :val')
        ->orWhere('u.prenom like :val')
        ->setParameter('val', '%'.$term.'%')
        ->andWhere('u.statut= :st')
        ->setParameter('st','actif')
        ->getQuery()
        ->getResult();
    }

}
