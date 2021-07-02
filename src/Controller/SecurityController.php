<?php

namespace App\Controller;
use App\Form\RegistrationType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/security", name="security")
     */
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request,UserPasswordEncoderInterface $encoder,EntityManagerInterface $entitymanger){
        $user=new User();
        $form=$this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // pour faire le cryptage de notre password
            $hash=$encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            
            $entitymanger->persist($user);
            $entitymanger->flush();
            return $this->redirectToRoute('security_login');
        }
        return $this->render('security/regisration.html.twig', ['form'=>$form->createView()]);
    }
    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        return $this->render('security/login.html.twig');
    }
    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){}
}
