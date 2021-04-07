<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Entity\Groupetag;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeTagTagsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $groupeTags = new Groupetag();
        $groupeTags -> setLibelle("FrontEnd");
        $manager->persist($groupeTags);

        $tags = ["PHP", "JavaScript","Ajax","Json"];
        for ($i=0; $i < 4; $i++) { 
            $tag = new Tag();
            $tag -> setLibelle($tags[$i]);
            $tag -> setDescriptif("Descriptif de ce tag");
            $tag -> addGroupetag($groupeTags);
            $manager->persist($tag);
        }

        $manager->flush();
    }
}
