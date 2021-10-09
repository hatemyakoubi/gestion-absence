<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Form\AbscenceType;
use App\Form\CandidatType;
use App\Entity\SeanceCours;
use App\Form\SeanceCoursType;
use App\Form\AbscenceSeanceType;
use App\Form\CandidatSeanceAbscence;
use App\Repository\CandidatRepository;
use App\Form\CandidatSeanceAbscenceType;
use App\Repository\SeanceCoursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/seancecours")
 */
class SeanceCoursController extends AbstractController
{
    /**
     * @Route("/", name="seance_cours_index", methods={"GET"})
     */
    public function index(SeanceCoursRepository $seanceCoursRepository): Response
    {
        return $this->render('seance_cours/index.html.twig', [
            'seance_cours' => $seanceCoursRepository->findAll(),
            'controller_name' => ' Liste des séances',
        ]);
    }

    /**
     * @Route("/new", name="seance_cours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
          
        $seanceCour = new SeanceCours();
        $form = $this->createForm(SeanceCoursType::class, $seanceCour);
        $form->handleRequest($request);
         if ($form->isSubmitted() && $form->get('Enregistrer')->isClicked()&& $form->isValid()) {
      
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seanceCour);
            $entityManager->flush();

            return $this->redirectToRoute('seance_cours_index');
        }

      

        return $this->render('seance_cours/new.html.twig', [
             'seance_cour' => $seanceCour,
            'form' => $form->createView(),
            'controller_name' => ' Crée une nouvelle seance',
        ]);
    }

    /**
     * @Route("/{id}", name="seance_cours_show", methods={"GET"})
     */
    public function show(SeanceCours $seanceCour): Response
    {

     /*   $Candidat = $CandidatRepository->find($id);
            $form = $this->createForm(CandidatSeanceAbscenceType::class, $Candidat);
            $form->handleRequest($request);

*/
        return $this->render('seance_cours/show.html.twig', [
            //'Candidat' => $Candidat,
           // 'form' => $form->createView(),
            'seance_cour' => $seanceCour,
            'controller_name' => ' Affiche séance',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seance_cours_edit", methods={"GET","POST"})
     * 
     */
    public function edit($id,Request $request, SeanceCours $seanceCour): Response
    {
  
        $form = $this->createForm(AbscenceSeanceType::class, $seanceCour);
        $form->handleRequest($request);
      
        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seance_cours_show',['id' => $seanceCour->getId()]);
        }

        return $this->render('seance_cours/edit.html.twig', [
            'seance_cour' => $seanceCour,
            'form' => $form->createView(),
            'controller_name' => ' Modifier séances',
        ]);
    }

    /**
     * @Route("/{id}", name="seance_cours_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SeanceCours $seanceCour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seanceCour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seanceCour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seance_cours_index');
    }

    /**
     * @Route("/seanceabscence/{id}", name="abscence_seance_cours_show", methods={"GET"})
     */
    public function showSeanceAbscence(SeanceCours $seanceCour): Response
    {
  
    return $this->render('seance_cours/abscence.html.twig', [
            'seance_cour' => $seanceCour,
            'controller_name' => ' Affiche séance',
        ]);
    }

   /**
     * @Route ("/{id}/add-Abscence",name="abscence_candidat_seance")
     * @param Request $request
     * @param CandidatRepository $CandidatRepository
     * @param $id
     */
    public function addAbscence(Request $request,CandidatRepository $CandidatRepository,$id):Response
    {

        $Candidat = $CandidatRepository->find($id);
        $form = $this->createForm(CandidatSeanceAbscenceType::class, $Candidat);
        $form->handleRequest($request);
       
       // dd($seancecours);
        return $this->render('seance_cours/show.html.twig', [
            'Candidat' => $Candidat,
            'form' => $form->createView(),
            'controller_name' => 'Affecter un abscence',
        ]);
        
    } 

    
}
