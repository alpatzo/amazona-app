<?php

namespace App\Controller;
use App\Entity\Job;
use App\Form\JobType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JobRepository;

class JobController extends AbstractController
{
    /**
     * @Route("/job", name="job")
     */
    public function index(): Response
    {
        return $this->render('job/index.html.twig', [
            'controller_name' => 'JobController',
        ]);
    }
    /**
     * @Route("/save", name="save")
     */
    public function save(){
        $entitymanager=$this->getDoctrine()->getManager();
        $job=new Job();
        $job->setCategory('médcine');
        $job->setSousCategory('dentiste');
        $entitymanager->persist($job);
        $entitymanager->flush();

        return new Response('save this job '.$job->getId().' de categorie '.$job->getCategory());
    }
    /**
     * @Route("/job", name="job")
     */
    public function jobs(JobRepository $repository){
        $job=$repository->findAll();
        return $this->render("job/index.html.twig",['job'=>$job]);
    }
    /**
     * @Route("/job/{id}", name="jobbyid")
     */
    public function jobbyid($id){
        $job=$this->getDoctrine()->getRepository(Job::class)->find($id);
        return $this->render('job/category.html.twig',['job'=>$job]);
    }
    /**
     * @Route("/jobs/new", name="new")
     * Method({"GET", "POST"})
     */
    public function new(Request $request){
        $job=new Job();
        $form=$this->createForm(JobType::class,$job);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ){//&& = et ,|| = OR 
            $job=$form->getData();
            $entitymanager=$this->getDoctrine()->getManager();
            $entitymanager->persist($job);
            $entitymanager->flush();
            return $this->redirectToRoute('job');
        }    
        return $this->render('job/new.html.twig', ['form'=>$form->createView()]); 
    }
    /**
     * @Route("/jobs/edit/{id}", name="modifier")
     * Method({"GET", "POST"})
     */
    public function modifier(Request $request, $id){
        $job=new Job();
        $job=$this->getDoctrine()->getRepository(job::class)->find($id);
        $form=$this->createForm(JobType::class,$job);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entitymanager=$this->getDoctrine()->getManager();
            $entitymanager->flush();
            return $this->redirectToRoute('job');
        }
        return $this->render('job/modifier.html.twig', ['form'=>$form->createView()]);
    }
    /**
     * @Route("/jobs/supp/{id}", name="supprimer")
     */
    public function supprimer($id){
        $job=new Job();
        $entitymanager=$this->getDoctrine()->getManager();
        $supp=$entitymanager->getRepository(job::class)->find($id);
        $entitymanager->remove($supp);
        $entitymanager->flush();
        return $this->redirectToRoute('job');
    }
}
