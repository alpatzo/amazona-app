<?php

namespace App\Controller;
use App\Entity\Annoces;
use App\Form\AnnoncesType;
use App\Repository\AnnocesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AnnoncesController extends AbstractController
{
    /**
     * @Route("/annonces", name="annonces")
     */
    public function annonces(AnnocesRepository $repository)
    {
        $annonces= $repository->findAll();
        return $this->render('annonces/index.html.twig', ['annonces'=>$annonces]);
    }
    /**
     * @Route("/annonces/add", name="ajouterannonce")
     */
    public function new(Request $request){
        $annonces=new Annoces();
        $form=$this->createForm(AnnoncesType::class,$annonces);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadFile $imageFile */
            $imageFile=$form->get('image')->getData();
            if($imageFile){
                $origenalFilename=pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename=$origenalFilename;
                $newFilename=$safeFilename."-".uniqid().".".$imageFile->guessExtension();
                try{
                    $imageFile->move($this->getParameter(('image'), $newFilename),$newFilename);
                }catch(FileException $e){}
                $annonces->setImage($newFilename);
            }
            $annonces=$form->getData();
            $entityManger=$this->getDoctrine()->getManager();
            $entityManger->persist($annonces);
            $entityManger->flush();
            return $this->redirectToRoute('annonces');
        }
        return $this->render('annonces/new.html.twig', ['form'=>$form->createView()]);
    }
    /**
     * @Route("/annonces/edit/{id}", name="edit_annonces")
     */
    public function edit(Request $request, $id){
        $annonces=new Annoces();
        $annonces= $this->getDoctrine()->getRepository(Annoces::class)->find($id);
        $form=$this->createForm(AnnoncesType::class,$annonces);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadFile $imageFile */
            $imageFile=$form->get('image')->getData();
            if($imageFile){
                $origenalFilename=pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename=$origenalFilename;
                $newFilename=$safeFilename."-".uniqid().".".$imageFile->guessExtension();
                try{
                    $imageFile->move($this->getParameter(('image'), $newFilename),$newFilename);
                }catch(FileException $e){}
                $annonces->setImage($newFilename);
            }
            $entityManger=$this->getDoctrine()->getManager();
            $entityManger->flush();
            return $this->redirectToRoute('annonces');
        }
        return $this->render('annonces/edit.html.twig', ['form'=>$form->createView()]);
    }
    /**
     *@Route("/annonces/supp/{id}", name="supprimer_annonces")
     */
    public function supprimer($id){
        $annonces=new Annoces();
        $entityManger=$this->getDoctrine()->getManager();
        $supp=$entityManger->getRepository(Annoces::class)->find($id);
        $entityManger->remove($supp);
        $entityManger->flush();
        return $this->redirectToRoute('annonces');
    }
    /**
     *@Route("/annonce/{id}", name="annonce_show")
     */
    public function show(Request $request, $id){
        $annonces=new Annoces();
        $form=$this->createForm(AnnoncesType::class,$annonces);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadFile $imageFile */
            $imageFile=$form->get('image')->getData();
            if($imageFile){
                $origenalFilename=pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename=$origenalFilename;
                $newFilename=$safeFilename."-".uniqid().".".$imageFile->guessExtension();
                try{
                    $imageFile->move($this->getParameter(('image'), $newFilename),$newFilename);
                }catch(FileException $e){}
                $annonces->setImage($newFilename);
            }
            $entityManger=$this->getDoctrine()->getRepository(Annoces::class)->find($id);
            
        }
        return $this->render('annonces/detail.html.twig', array('form'=>$form->createView(),'annonces'=>$annonces));
    }
}
