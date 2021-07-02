<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {
        return new Response("hello symfony");
    }
    /**
     * @Route("/numero")
     */
    public function number()
    {
        $number = random_int(0, 10);

        return $this->render('lucky/number.html.twig', [
            'num' => $number,
        ]);
    }
    /**
     * @Route("/redirec")
     */
    public function redire(){
        return $this->redirectToRoute("test");
    }
    /**
     * @Route("/testid/{id}", name="testid")
     */
    public function testid($id){
        return new Response("afficher notre id :".$id);
    }
}
