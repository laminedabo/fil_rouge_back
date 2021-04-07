<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Niveau;
use App\Entity\Competence;
use App\Entity\Groupecompetence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
       $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
   
        $niveaux = ["Niveau1","Niveau2","Niveau3"];
        $critereEvaluation = ["CritereEvaluation1","CritereEvaluation2","CritereEvaluation3"];
        $competences = ["Connaissances solide en PHP","excellent niveau en Bootsrap","bon niveux en Ajax"];

        $grpCompetence = new Groupecompetence();
        $grpCompetence -> setLibelle("Developper le backend d'une appli");
        $grpCompetence -> setDescriptif("Le descriptif pour developper le backend d'une application web");
        $grpCompetence -> addReferentiel($this -> getReference("referentiel1"));

        for ($i=0; $i < 3; $i++) { 
            $competence = new Competence();
            $competence -> setlibelle($competences[$i]);
            for ($j=0; $j < 3; $j++) {
                $niveau = new Niveau();
                $niveau -> setLibelle($niveaux[$j]);
                $niveau -> setCritereEvaluation($critereEvaluation[$i]);
                $niveau -> setGroupeAction("Action A, Action B, Action C");
                $competence -> addNiveau($niveau);
                $manager->persist($niveau);
                $manager->persist($competence);
            }
            $grpCompetence -> addCompetence($competence);
        }
        $grpCompetence -> setUser($this -> getReference("creator"));
        $manager->persist($grpCompetence);
        $manager->flush();
    }

    //Executer ReferentielFixtures avant cette classe ci
    public function getDependencies(){
        return array(
            ReferentielFixtures::class,
            UserFixtures::class
        );
    }
}
