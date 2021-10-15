<?php

namespace App\Controller\banque;

use App\Entity\banque\TypeCompte;
use App\Form\Type\banque\TypeCompteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/compte")
 */
class TypeCompteController extends AbstractController
{
    /**
     * @Route("/", name="type_compte_index", methods={"GET"})
     */
    public function index(): Response
    {
        $typeComptes = $this->getDoctrine()
            ->getRepository(TypeCompte::class)
            ->findAll();

        return $this->render('banque/type_compte/index.html.twig', [
            'type_comptes' => $typeComptes,
        ]);
    }

    /**
     * @Route("/new", name="type_compte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeCompte = new TypeCompte();
        $form = $this->createForm(TypeCompteType::class, $typeCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeCompte);
            $entityManager->flush();

            return $this->redirectToRoute('type_compte_index');
        }

        return $this->render('banque/type_compte/new.html.twig', [
            'type_compte' => $typeCompte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_compte_show", methods={"GET"})
     */
    public function show(TypeCompte $typeCompte): Response
    {
        return $this->render('banque/type_compte/show.html.twig', [
            'type_compte' => $typeCompte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_compte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeCompte $typeCompte): Response
    {
        $form = $this->createForm(TypeCompteType::class, $typeCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_compte_index');
        }

        return $this->render('banque/type_compte/edit.html.twig', [
            'type_compte' => $typeCompte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_compte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeCompte $typeCompte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeCompte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeCompte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_compte_index');
    }
}
