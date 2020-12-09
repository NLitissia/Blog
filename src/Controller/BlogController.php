<?php

namespace App\Controller;

use App\Entity\Pub;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(): Response
    {   $repo = $this->getDoctrine()->getRepository(Pub::class);
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
     * @Route("/show/{id}" , name="blog_show")
     */
    public function show($id){
        $rep = $this->getDoctrine()->getRepository(Pub::class);
        $pub = $rep->find($id);
        return $this->render('blog/show.html.twig',[
            'pub' => $pub
        ]);
    }    
}
