<?php

namespace App\DataPersister;

use App\Entity\Profilsortie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class ProfilsortieDataPersister implements DataPersisterInterface
{


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports($profilsorite): bool
    {
        return $profilsorite instanceof Profilsortie;
    }

    /**
     * @param Profilsortie $profilsorite
     */
    public function persist($profilsorite)
    {
        return $this->em->persist($profilsorite);
        $this->em->flush();
    }

    public function remove($profilsorite)
    {
        $profilsorite -> setStatut("archived");
        $this->em->persist($profilsorite);
        $this->em->flush();
        return new JsonResponse("archivage reussi",200, [], true);
        // $this->em->remove($profilsorite);
    }
}
