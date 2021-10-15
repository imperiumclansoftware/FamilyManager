<?php

namespace App\Controller\banque;

use App\Entity\banque\Carte;
use App\Form\Type\banque\CarteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carte")
 */
class CarteController extends AbstractController
{
    /**
     * @Route("/", name="carte_index", methods={"GET"})
     */
    public function index(): Response
    {
        $cartes = $this->getDoctrine()
            ->getRepository(Carte::class)
            ->findAll();

        return $this->render('banque/carte/index.html.twig', [
            'cartes' => $cartes,
        ]);
    }

    /**
     * @Route("/new", name="carte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carte = new Carte();
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carte);
            $entityManager->flush();

            return $this->redirectToRoute('carte_index');
        }

        return $this->render('banque/carte/new.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_show", methods={"GET"})
     */
    public function show(Carte $carte): Response
    {
        return $this->render('banque/carte/show.html.twig', [
            'carte' => $carte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Carte $carte): Response
    {
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carte_index');
        }

        return $this->render('banque/carte/edit.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Carte $carte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carte_index');
    }
}
