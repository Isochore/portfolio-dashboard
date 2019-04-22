<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Projet;

class ProjetsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $projet = new Projet();
            $projet->setTitle("Titre du projet n°$i")
                    ->setContent("<p>Contenu du projet n°$i</p>")
                    ->setImage("http://placehold.it/350x150")
                    ->setLink("Lien du projet n°$i");
                    
            $manager->persist($projet);
        }
        $manager->flush();
    }
}
