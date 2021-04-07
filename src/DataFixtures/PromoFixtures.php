<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Promo;
use DateTimeInterface;
use App\Entity\Formateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PromoFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
        
        $promo1 = new Promo();        
        $promo2 = new Promo();

        $promo1 -> setUser($manager-> getRepository(User::class) -> find(13));
        $promo2 -> setUser($manager-> getRepository(User::class) -> find(14));
        $promo1 -> addFormateur($this -> getReference("formateur6"));
        $promo2 -> addFormateur($this -> getReference("formateur7"));

        $this -> commonSet($promo1,1);
        $this -> commonSet($promo2,2);
        
        $this -> addReference("promo1", $promo1);
        $this -> addReference("promo2", $promo2);
        $manager->persist($promo1);
        $manager->persist($promo2);
        $manager->flush();
    }

    public function commonSet($promo, $i){
        $promo -> setLangue("Fr");
        $promo -> setTitre("promo ".$i);
        $promo -> setDescription("Description promo ".$i);
        $promo -> setLieu("Lieu de la promo ".$i);
        $promo -> setDateDebut(new \Datetime());
        $promo -> setFabrique("SA");
        $promo -> setEtat("actif");
        $promo -> setDateFinProvisoire(new \Datetime());
        $promo -> setReferentiel($this -> getReference("referentiel".$i));
    }

    public function getDependencies(){
        return array(
            ReferentielFixtures::class,
            UserFixtures::class,
        );
    }

    public static function getGroups():array{
        return ['groupe_promo'];
    }
}