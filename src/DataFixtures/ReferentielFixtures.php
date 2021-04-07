<?php

namespace App\DataFixtures;

use App\Entity\Referentiel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class ReferentielFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 2; $i++) {
            $referentiel = new Referentiel();
            $referentiel -> setLibelle("Libelle referentiel ".$i);
            $referentiel -> setPresentation("Presentation referentiel ".$i);
            $referentiel -> setProgramme("Programme referentiel".$i);
            $referentiel -> setCritereAdmission("Critère d'admission referentiel".$i);
            $referentiel -> setCritereEvaluation("Critère d'évaluation referentiel".$i);
            $this -> addReference("referentiel".$i, $referentiel);
            $manager->persist($referentiel);
        }
        $manager->flush();
    }

    public static function getGroups():array{
        return ['groupe_promo'];
    }
}
