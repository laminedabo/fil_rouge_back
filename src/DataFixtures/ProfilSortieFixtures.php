<?php

namespace App\DataFixtures;

use App\Entity\Profilsortie;
use DateTimeInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProfilSortieFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 2; $i++) { 
            $profilsortie =new Profilsortie();
            $profilsortie -> setLibelle("ProfilSortie".$i);
            $profilsortie -> setStatut("actif");
            if ($i===1) {
                for ($j=9; $j <= 11; $j++) { 
                    $profilsortie -> addApprenant($this -> getReference("apprenant".$j));
                }
            }
            else {
                for ($j=12; $j <= 14; $j++) { 
                    $profilsortie -> addApprenant($this -> getReference("apprenant".$j));
                }
            }
            $manager -> persist($profilsortie);
        }
        
        $manager->flush();
    }

    public function getDependencies(){
        return array(
            UserFixtures::class
        );
    }

    public static function getGroups():array{
        return ['groupe_promo'];
    }
}
