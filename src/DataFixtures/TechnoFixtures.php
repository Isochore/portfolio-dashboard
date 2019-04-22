<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Technology;

class TechnoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $techno = new Technology();
            $techno->setName("Nom de la techno n°$i");
                    
            $manager->persist($techno);
        }
        $manager->flush();
    }
}
