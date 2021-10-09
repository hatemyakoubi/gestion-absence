<?php

namespace App\Controller;

use App\Repository\CandidatRepository;
use App\Repository\PublicationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(CandidatRepository $candidatRepository): Response
    {
        
        return $this->render('home/index.html.twig', [
           
            'controller_name' => 'Acceuil',
           
        ]);
    }
    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'A propos',
        ]);
    }
    /**
     * @Route("/publicationEvents", name="publierevents")
     */
    public function publication(PublicationRepository $publicationRepository): Response
    {
        $publications =  $publicationRepository->findAll();
         return $this->render('home/publication.html.twig', [
            'publications'=>$publications,
            'controller_name' => 'Publication ',
        ]);
    }
    
    
       
   
}
