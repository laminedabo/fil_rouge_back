<?php

namespace App\DataPersister;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class UserDataPersister implements DataPersisterInterface
{


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports($user): bool
    {
        return $user instanceof User;
    }

    /**
     * @param User $user
     */
    public function persist($user)
    {
        return $this->em->persist($user);
    }

    public function remove($user)
    {
        $user -> setStatut("archived");
        $this->em->persist($user);
        $this->em->flush();
        return new JsonResponse("archivage reussi",200, [], true);
    }
}
