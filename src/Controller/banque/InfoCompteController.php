<?php

namespace App\Controller\banque;

use App\Entity\banque\InfoCompte;
use App\Form\Type\banque\InfoCompteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/info/compte")
 */
class InfoCompteController extends AbstractController
{
    /**
     * @Route("/", name="info_compte_index", methods={"GET"})
     */
    public function index(): Response
    {
        $infoComptes = $this->getDoctrine()
            ->getRepository(InfoCompte::class)
            ->findAll();

        return $this->render('banque/info_compte/index.html.twig', [
            'info_comptes' => $infoComptes,
        ]);
    }

    /**
     * @Route("/new", name="info_compte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $infoCompte = new InfoCompte();
        $form = $this->createForm(InfoCompteType::class, $infoCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($infoCompte);
            $entityManager->flush();

            return $this->redirectToRoute('info_compte_index');
        }

        return $this->render('banque/info_compte/new.html.twig', [
            'info_compte' => $infoCompte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_compte_show", methods={"GET"})
     */
    public function show(InfoCompte $infoCompte): Response
    {
        return $this->render('banque/info_compte/show.html.twig', [
            'info_compte' => $infoCompte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="info_compte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InfoCompte $infoCompte): Response
    {
        $form = $this->createForm(InfoCompteType::class, $infoCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_compte_index');
        }

        return $this->render('banque/info_compte/edit.html.twig', [
            'info_compte' => $infoCompte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="info_compte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InfoCompte $infoCompte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infoCompte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($infoCompte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('info_compte_index');
    }
}
