<?php

namespace App\DataPersister;

use App\Entity\Groupetag;
use App\Entity\Competence;
use App\Entity\Referentiel;
use App\Entity\Groupecompetence;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;

class DataPersister1 implements DataPersisterInterface
{


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function supports($entity): bool
    {
        return $entity instanceof Competence || $entity instanceof Groupecompetence || $entity instanceof Referentiel || $entity instanceof Groupetag;
    }

    /**
     * @param Competence $competence
     * @param Groupecompetence $groupecompetence
     * @param Groupetag $groupetag
     * @param Referentiel $referentiel
     */
    public function persist($entity)
    {
        return $this->em->persist($entity);
        $this->em->flush();
    }

    public function remove($entity)
    {

        $entity -> removeMembers();
        
        $entity -> setStatut("archived");
        $this->em->persist($entity);
        $this->em->flush();
        return new JsonResponse("archivage reussi",200, [], true);
    }
}
