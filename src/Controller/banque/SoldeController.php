<?php

namespace App\Controller\banque;

use App\Entity\banque\Solde;
use App\Form\Type\banque\SoldeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/solde")
 */
class SoldeController extends AbstractController
{
    /**
     * @Route("/", name="solde_index", methods={"GET"})
     */
    public function index(): Response
    {
        $soldes = $this->getDoctrine()
            ->getRepository(Solde::class)
            ->findAll();

        return $this->render('banque/solde/index.html.twig', [
            'soldes' => $soldes,
        ]);
    }

    /**
     * @Route("/new", name="solde_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $solde = new Solde();
        $form = $this->createForm(SoldeType::class, $solde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($solde);
            $entityManager->flush();

            return $this->redirectToRoute('solde_index');
        }

        return $this->render('banque/solde/new.html.twig', [
            'solde' => $solde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solde_show", methods={"GET"})
     */
    public function show(Solde $solde): Response
    {
        return $this->render('banque/solde/show.html.twig', [
            'solde' => $solde,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="solde_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Solde $solde): Response
    {
        $form = $this->createForm(SoldeType::class, $solde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('solde_index');
        }

        return $this->render('banque/solde/edit.html.twig', [
            'solde' => $solde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solde_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Solde $solde): Response
    {
        if ($this->isCsrfTokenValid('delete'.$solde->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($solde);
            $entityManager->flush();
        }

        return $this->redirectToRoute('solde_index');
    }
}
