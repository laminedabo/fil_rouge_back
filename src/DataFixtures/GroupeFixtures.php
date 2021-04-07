<?php

namespace App\DataFixtures;

use App\Entity\Groupe;
use DateTimeInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GroupeFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 2; $i++) { 
            $groupe =new Groupe();
            $groupe -> setNom("groupe1 promo ".$i);
            $groupe -> setDateCreation(new \DateTime());
            $groupe -> setType("principal");
            $groupe -> setStatut("actif");
            $groupe -> setPromo($this -> getReference("promo".$i));
            if ($i===1) {
                $groupe -> addFormateur($this->getreference("formateur6"));
                for ($j=9; $j <= 11; $j++) { 
                    $groupe -> addApprenant($this -> getReference("apprenant".$j));
                }
            }
            else {
                $groupe -> addFormateur($this->getreference("formateur7"));
                for ($j=12; $j <= 14; $j++) { 
                    $groupe -> addApprenant($this -> getReference("apprenant".$j));
                }
            }
            $manager -> persist($groupe);
        }
        
        $manager->flush();
    }

    public function getDependencies(){
        return array(
            PromoFixtures::class,
            UserFixtures::class
        );
    }

    public static function getGroups():array{
        return ['groupe_promo'];
    }
}
