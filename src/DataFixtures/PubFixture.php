<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pub;
use DateTime;

class PubFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

       $faker = \Faker\Factory::create('fr_FR');
       //creation des categorie

       for($i=0;$i<=3;$i++) {
           $category = new Category();
           $category->setTitre($faker->sentence())
                    ->setDescription($faker->paragraph());

                    $manager->persist($category);

                    for($j=0;$j<=mt_rand(4,6);$j++) {
                        $pub = new Pub();
                        
                        $content= '<p>'.join($faker->paragraphs(5),'</p><p>').'</p>';
                        $pub->setTitre($faker->sentence())
                            ->setContenu($content)
                            ->setImage($faker->imageUrl($width = 640, $height = 480))
                            ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                            ->setCategory($category);
                        
                            $manager->persist($pub);
                    //commentaires 
                      for($k=1;$k<=mt_rand(4,10);$k++){
                           $comment = new Comment();
                           $now = new \DateTime();
                           $days = $now->diff($pub->getCreatedAt())->days;
                           $min = '-'.$days.'days';

                           $content= '<p>'.join($faker->paragraphs(5),'</p><p>').'</p>';
                           $comment->setAuthor($faker->name)
                                   ->setContenu($content)
                                   ->setCreatedAt($faker->dateTimeBetween($min))
                                   ->setRelation($pub);

                                   $manager->persist($comment);
                      }      

                    }    
        }

    //    for($i=0; $i <= 10; $i++){
    //        $pub = new Pub();
    //        $pub->setTitre("Publication - " .($i+1))
    //            ->setContenu("Un paragraphe est une section de texte en prose vouée au développement d'un point particulier souvent au moyen de plusieurs phrases, dans la continuité du précédent et du suivant. Sur le plan typographique, 
    //            le début d'un paragraphe est marqué par un léger renfoncement ou par un saut de ligne")
    //            ->setImage("http://placehold.it/350x150")
    //            ->setCreatedAt(new \DateTime());
    //         $manager->persist($pub);   
    //    }
        
        $manager->flush();
    }
}
