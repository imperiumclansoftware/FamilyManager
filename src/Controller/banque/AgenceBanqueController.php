<?php

namespace App\Controller\banque;

use App\Entity\banque\AgenceBanque;
use App\Form\Type\banque\AgenceBanqueType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("agence/banque")
 */
class AgenceBanqueController extends AbstractController
{
    /**
     * @Route("/agence/banque/index", name="agence_banque_index", methods={"GET"})
     */
    public function index(): Response
    {
        $agencebanques = $this->getDoctrine()
            ->getRepository(AgenceBanque::class)
            ->findAll();

        return $this->render('banque/ongletBanque/decoupeOngletB/etabEtabliB.html.twig', [
            'agencebanques' => $agencebanques,
            'test' => 'test'
        ]);
    }

    /**
     * @Route("/new", name="agence_banque_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $agenceBanque = new AgenceBanque();
        $form = $this->createForm(AgenceBanqueType::class, $agenceBanque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($agenceBanque);
            $entityManager->flush();

            return $this->redirectToRoute('agence_banque_index');
        }

        return $this->render('banque/agence_banque/new.html.twig', [
            'agence_banque' => $agenceBanque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="agence_banque_show", methods={"GET"})
     */
    public function show(AgenceBanque $agenceBanque): Response
    {
        return $this->render('banque/agence_banque/show.html.twig', [
            'agence_banque' => $agenceBanque,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="agence_banque_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AgenceBanque $agenceBanque): Response
    {
        $form = $this->createForm(AgenceBanqueType::class, $agenceBanque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agence_banque_index');
        }

        return $this->render('banque/agence_banque/edit.html.twig', [
            'agence_banque' => $agenceBanque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="agence_banque_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AgenceBanque $agenceBanque): Response
    {
        if ($this->isCsrfTokenValid('delete' . $agenceBanque->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($agenceBanque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agence_banque_index');
    }
}
