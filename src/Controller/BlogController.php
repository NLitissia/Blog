<?php

namespace App\Controller;

use App\Entity\Pub;
use App\Form\PubType;
use App\Repository\PubRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(PubRepository $repo): Response
    {   
        $pubs = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'pubs' =>$pubs
        ]);
    }
    /**
     * @Route("/", name="home")
     */

    public function home(){
        return $this->render('blog/home.html.twig', ['title' => "Bienvenu"]);
        }

    /**
     * @Route("/blog/new", name="blog_create")
     */

    public function form(Request $request,   ManagerRegistry $manager){

        $pub = new Pub();
    
        // $form = $this->createFormBuilder($pub)
        //              ->add('titre',TextType::class,[
        //                  'attr' => [
        //                      'placeholder' => "Titre de la publication",
                             
        //                  ]
        //              ])
        //              ->add('contenu', TextareaType::class,[
        //                  'attr' => [
        //                      'placeholder' => "Contenu de la publication"
        //                  ]
        //              ])
        //              ->add('image',TextType::class,[
        //                 'attr' => [
        //                     'placeholder' => "image de la publication",
                            
        //                 ]
        //             ])
        //             ->add('Enregistrer', SubmitType::class,[
        //                 'attr' => [
        //                     'class' => "BtnSave"
                            
        //                 ]
                       
        //             ])
        //              ->getForm();

        $form = $this->createForm(PubType::class,$pub);

                $form->handleRequest($request);  
                dump($request); 
                if($form->isSubmitted() && $form->isValid()) {
                    $pub->setCreatedAt(new \DateTime());
                    $em = $manager->getManager();
                    $em -> persist($pub);
                    $em->flush();

                   return $this->redirectToRoute('blog_show',['id' => $pub->getId()]);
                }  

        return $this->render('blog/create.html.twig',[
            'formPub' => $form->createView()
         ]);
   }    
    /**
     * @Route("/blog/{id}" , name="blog_show")
     */
    public function show(Pub $pub){
        //dump($pub->getComments()).die();
        return $this->render('blog/show.html.twig',[
            'pub' => $pub
        ]);
    }    

}
