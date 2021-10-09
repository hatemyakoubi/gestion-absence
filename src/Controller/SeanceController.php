<?php

namespace App\Controller;

use App\Entity\Seance;

use App\Form\SeanceType;
use App\Entity\Formation;
use App\Entity\Enseignant;
use App\Form\AffecteSeanceType;
use App\Repository\SeanceRepository;
use App\Repository\CandidatRepository;
use App\Repository\FormationRepository;
use App\Repository\EnseignantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/seance")
 */
class SeanceController extends AbstractController
{
    /**
     * @Route("/", name="seance_index", methods={"GET"})
     */
    public function index(SeanceRepository $seanceRepository): Response
    {
        return $this->render('seance/index.html.twig', [
            'seances' => $seanceRepository->findAll(),
            'controller_name' => 'Listes des Séances'
        ]);
    }

  
 /**
     * @Route("/new", name="seance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
  {
    $seance = new Seance();
    $form = $this->createForm(SeanceType::class, $seance);
    $form->handleRequest($request);

    /*if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($seance);
    
       $entityManager->flush();

        return $this->redirectToRoute('seance_index');
    }*/

    return $this->render('seance/new.html.twig', [
        'seance' => $seance,
        'form' => $form->createView(),
        'controller_name' => 'Crée une séance',
    ]);
}


    /**
     * @Route("/{id}", name="seance_show", methods={"GET"})
     */
    public function show(Seance $seance): Response
    {
        return $this->render('seance/show.html.twig', [
            'seance' => $seance,
            'controller_name' => 'Détaille séance'
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Seance $seance): Response
    {
        $form = $this->createForm(SeanceType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seance_index');
        }

        return $this->render('seance/edit.html.twig', [
            'seance' => $seance,
            'form' => $form->createView(),
            'controller_name' => 'Modifier une Séance'
        ]);
    }

    /**
     * @Route("/{id}", name="seance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Seance $seance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seance_index');
    }
    /**
     * @Route("/ajoutseance/ajax/{label}", name="ajoutajax_seance")
     * @return Response
     */
    function ajoutajax_seance($label,FormationRepository $formationRepository): Response{

        return $this->render('seance/ajoutseance.html.twig',[
            'formation'=>$formationRepository->findOneByFormation($label),
        ]);

    }

    
}
