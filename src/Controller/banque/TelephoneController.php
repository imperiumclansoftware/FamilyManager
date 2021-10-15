<?php

namespace App\Controller\banque;

use App\Entity\banque\Telephone;
use App\Form\Type\banque\TelephoneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/telephone")
 */
class TelephoneController extends AbstractController
{
    /**
     * @Route("/", name="telephone_index", methods={"GET"})
     */
    public function index(): Response
    {
        $telephones = $this->getDoctrine()
            ->getRepository(Telephone::class)
            ->findAll();

        return $this->render('banque/telephone/index.html.twig', [
            'telephones' => $telephones,
        ]);
    }

    /**
     * @Route("/new", name="telephone_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $telephone = new Telephone();
        $form = $this->createForm(TelephoneType::class, $telephone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($telephone);
            $entityManager->flush();

            return $this->redirectToRoute('telephone_index');
        }

        return $this->render('banque/telephone/new.html.twig', [
            'telephone' => $telephone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="telephone_show", methods={"GET"})
     */
    public function show(Telephone $telephone): Response
    {
        return $this->render('banque/telephone/show.html.twig', [
            'telephone' => $telephone,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="telephone_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Telephone $telephone): Response
    {
        $form = $this->createForm(TelephoneType::class, $telephone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('telephone_index');
        }

        return $this->render('banque/telephone/edit.html.twig', [
            'telephone' => $telephone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="telephone_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Telephone $telephone): Response
    {
        if ($this->isCsrfTokenValid('delete'.$telephone->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($telephone);
            $entityManager->flush();
        }

        return $this->redirectToRoute('telephone_index');
    }
}
