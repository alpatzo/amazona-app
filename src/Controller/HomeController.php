<?php

namespace App\Controller;

use App\Entity\Annoces;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $annonces= $this->getDoctrine()->getRepository(Annoces::class)->findAll();
        return $this->render('home/index.html.twig', ['annonces'=>$annonces]);
    }
}
