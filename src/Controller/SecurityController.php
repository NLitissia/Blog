<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ManagerRegistry $manager, UserPasswordEncoderInterface $encoder){
        $user = new User();
        $em = $manager->getManager();
        
        $form = $this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($encoded);
            $em->persist($user);
            $em->flush();

            $this->redirectToRoute('security/login.html.twig');

        }

        return $this->render('security/registration.html.twig',[
            'form'=> $form->createView()
        ]);

    }
    /**
     * 
     * @Route("/login",name="login")
     */
    public function login(){

        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
    }
}
