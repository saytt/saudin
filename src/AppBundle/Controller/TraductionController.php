<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\PhraseFrancais;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * Description of TraductionController
 *
 * @author y
 */

class TraductionController extends Controller{
    //put your code here
   
  
 
    /**
     * Liste l'ensemble des articles triés par date de publication pour une page donnée.
     *
     * @Route("/index")
     *
     * 
     */
 public function searchAction(Request $request){

     $result=null;
     $allPhrases=null;
     $query=null;
        $phrase=$request->query->get('ph');
       // var_dump($phrase); die();
        if($phrase!=null){
            $repository=$this->getDoctrine()->getRepository('AppBundle:PhraseFrancais');
            $query=$repository->createQueryBuilder('p')
                    ->where('p.phrase LIKE :motif')
                    ->setParameter('motif','%'.$phrase.'%')  
                    ->getQuery();
            $allPhrases=$query->getResult();
         /*
         * @var $paginator \Knp\Component\Pager\Paginator
         */
     $paginator =$this->get('knp_paginator');
     $result=$paginator->paginate(
             $allPhrases,
             $request->query->getInt('page', 1),
             $request->query->getInt('limit',10)
             ); 
        }
        
             
        return $this->render('default/index.html.twig ', array('resultPhrases'=>$result));
 }

  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * 
     * 
     * @Route("/modifValid", name="modifValid")  
     *    
     */
     public function modifValidAction(Request $modifValid){
        
        
         
         return $this->render('default/modifValid.html.twig',array('modifValid'=>$modifValid));
    }
    /**
     * @Route ("/cours", name="cours_japonais")
     */
        
    public function coursAction(Request $cours){
        
         //$leçon= $this->getDoctrine()->getRepository('AppBundle:LeçonJaponais')->findAll();
         
         return $this->render('default/cours.html.twig',array('cours'=>$cours));
    }
    /**
     * @Route("/caracteres", name="liste_caractères")
     */
    public function kanjiAction(Request $kanji){
        return $this->render('default/caracteres.html.twig');
        
    }
    
    /**
     *
     *
     * @Route("/update/{id}", name="Modification de phrase")
     * 
     */
   
    public function updateAction($id, Request $request){
        
        $em=$this->getDoctrine()->getManager();
        
        
        $phrase = $em->getRepository('AppBundle:PhraseFrancais')->find($id);
        if (!$phrase) {
            throw $this->createNotFoundException(
                    'pas de phrase trouvé pour cet id ' . $id
            );
        }
       $form = $this->createFormBuilder($phrase)
               ->add('phrase', TextType::class)
               ->add('phraseJap', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Modification'))
                ->getForm();
               
            
              
        if ($form->handleRequest($request)->isValid()) {
            
            $em->flush();
            $request->getSession()
                    ->getFlashBag()
                    ->add('notice','La phrase a bien été modifié')
            ;

            return $this->redirect($this->generateUrl('/index'));
        }
        return $this->render('default/update.html.twig', array(
            'form'=>$form->createView()
            
        ));
    }
  
     /**
     *
     *
     * @Route("/addPhrase", name="suggestion_de_traduction")
     * 
     */
    public function addAction(Request $request)

    {
      $phrase = new phraseFrancais();

        $form = $this->createFormBuilder($phrase)
        ->add('phrase', TextType::class)
        ->add('phraseJap', TextType::class)
         
        ->add('save', SubmitType::class, array('label' => 'Ajouter un nouvel exemple'))
        ->getForm();


      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phrase);
            $em->flush();

            $request->getSession()
                    ->getFlashBag()
                    ->add('success', 'Link ajouté avec succès!')
            ;

            return $this->redirect($this->generateUrl('cours', array('etat' => 'succes')
            ));
        }

        return $this->render('default/addPhrase.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
    /*public function displayAction(request $phrases)
    { 
        
        //$phrase2 = $this->addPhrase('test 2');
        $phrases =  $this->getDoctrine()->getRepository('AppBundle:PhraseFrancais')->findAll();
        
        
        return $this->render('default/index.html.twig ', array('ph'=>$phrases)); 
      */
     
 
     
      /*
 
       $phrase = new PhraseFrancais();
        
        $phrase->setPhrase('test2');      
        $phrase->setPhraseJap('試み');
        $em=$this->getDoctrine()->getManager();
        $em->persist($phrase); 
        $em->flush(); */
    
}

