<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Enseignant;
use App\Form\CandidatType;
use App\Form\AffecteSeanceType;
use App\Form\CandidatFormationType;
use App\Repository\CandidatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/candidat")
 */
class CandidatController extends AbstractController
{
    /**
     * @Route("/", name="candidat_index", methods={"GET"})
     */
    public function index(CandidatRepository $candidatRepository): Response
    {
        return $this->render('candidat/index.html.twig', [
            'candidats' => $candidatRepository->findAll(),
            'controller_name' => 'Listes des candidats'
        ]);
    }

    /**
     * @Route("/new", name="candidat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidat);
            $entityManager->flush();

            return $this->redirectToRoute('candidat_index');
        }

        return $this->render('candidat/new.html.twig', [
            'candidat' => $candidat,
            'form' => $form->createView(),
            'controller_name' => 'Nouveau candidat',
        ]);
    }

    /**
     * @Route("/{id}", name="candidat_show", methods={"GET"})
     */
    public function show(Candidat $candidat): Response
    {
        return $this->render('candidat/show.html.twig', [
            'candidat' => $candidat,
            'controller_name' => 'Affiche',
        ]);
    }

    /**
     * @Route("/{id}/edit", name="candidat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Candidat $candidat): Response
    {
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('candidat_index');
        }

        return $this->render('candidat/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form->createView(),
            'controller_name' => 'Modifier',
        ]);
    }

    /**
     * @Route("/{id}", name="candidat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Candidat $candidat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidat_index');
    }

    /**
     * @Route ("/{id}/add-formation",name="candidat_formation")
     * @param Request $request
     * @param CandidatRepository $candidatRepository
     * @param $id
     */
    public function addFormation(Request $request,CandidatRepository $candidatRepository,$id)
    {
        $candidat = $candidatRepository->find($id);
        $form = $this->createForm(CandidatFormationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $candidat->addFormation($form->get('formation')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($candidat);
            $entityManager->flush();
            return $this->redirectToRoute('candidat_show', ['id' => $candidat->getId()]);
        }
        return $this->render('candidat/affect.html.twig', [
            'candidat' => $candidat,
            'form' => $form->createView(),
            'controller_name' => 'Affecter une formation',
        ]);
    }


   
}
