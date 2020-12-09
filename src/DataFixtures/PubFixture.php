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
           $pub->setTitre("Publication - " .($i+1))
               ->setContenu("Un paragraphe est une section de texte en prose vouée au développement d'un point particulier souvent au moyen de plusieurs phrases, dans la continuité du précédent et du suivant. Sur le plan typographique, 
               le début d'un paragraphe est marqué par un léger renfoncement ou par un saut de ligne")
               ->setImage("http://placehold.it/350x150")
               ->setCreatedAt(new \DateTime());
            $manager->persist($pub);   
       }
        
        $manager->flush();
    }
}
