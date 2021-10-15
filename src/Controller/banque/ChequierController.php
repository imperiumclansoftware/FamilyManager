<?php

namespace App\Controller\banque;

use App\Entity\banque\Chequier;
use App\Form\Typebanque\ChequierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/chequier")
 */
class ChequierController extends AbstractController
{
    /**
     * @Route("/", name="chequier_index", methods={"GET"})
     */
    public function index(): Response
    {
        $chequiers = $this->getDoctrine()
            ->getRepository(Chequier::class)
            ->findAll();

        return $this->render('banque/chequier/index.html.twig', [
            'chequiers' => $chequiers,
        ]);
    }

    /**
     * @Route("/new", name="chequier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chequier = new Chequier();
        $form = $this->createForm(ChequierType::class, $chequier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chequier);
            $entityManager->flush();

            return $this->redirectToRoute('chequier_index');
        }

        return $this->render('banque/chequier/new.html.twig', [
            'chequier' => $chequier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chequier_show", methods={"GET"})
     */
    public function show(Chequier $chequier): Response
    {
        return $this->render('banque/chequier/show.html.twig', [
            'chequier' => $chequier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="chequier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chequier $chequier): Response
    {
        $form = $this->createForm(ChequierType::class, $chequier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chequier_index');
        }

        return $this->render('banque/chequier/edit.html.twig', [
            'chequier' => $chequier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="chequier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Chequier $chequier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chequier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chequier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chequier_index');
    }
}
