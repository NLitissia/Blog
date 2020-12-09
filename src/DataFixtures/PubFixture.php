<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pub;
class PubFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
       for($i=0; $i <= 10; $i++){
           $pub = new Pub();
           $pub->setTitre("titre de la Pubb......")
               ->setContenu("contenu de la Pub, le contenu le contenu")
               ->setImage("http://placehold.it/350x150")
               ->setCreatedAt(new \DateTime());
            $manager->persist($pub);   
       }
        
        $manager->flush();
    }
}
