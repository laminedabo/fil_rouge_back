<?php

namespace App\DataPersister;

use App\Entity\Profil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class ProfilDataPersister implements DataPersisterInterface
{


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports($profil): bool
    {
        return $profil instanceof Profil;
    }

    /**
     * @param Profil $profil
     */
    public function persist($profil)
    {
        $this->em->persist($profil);
        $this->em->flush();
    }

    public function remove($profil)
    {
        foreach ($profil -> getUsers() as $user) {
            $user -> setStatut("archived");
            $this->em->persist($user);
        }
        $profil -> setStatut("archived");
        $this->em->persist($profil);
        $this->em->flush();
        return new JsonResponse("archivage reussi",200, [], true);
        // $this->em->remove($profil);
    }
}
