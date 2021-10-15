<?php

namespace App\Controller\banque;

use App\Entity\banque\AdresseClient;
use App\Form\Type\banque\AdresseClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adresse/client")
 */
class AdresseClientController extends AbstractController
{
    /**
     * @Route("/", name="adresse_client_index", methods={"GET"})
     */
    public function index(): Response
    {
        $adresseClients = $this->getDoctrine()
            ->getRepository(AdresseClient::class)
            ->findAll();

        return $this->render('banque/adresse_client/index.html.twig', [
            'adresse_clients' => $adresseClients,
        ]);
    }

    /**
     * @Route("/new", name="adresse_client_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $adresseClient = new AdresseClient();
        $form = $this->createForm(AdresseClientType::class, $adresseClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adresseClient);
            $entityManager->flush();

            return $this->redirectToRoute('adresse_client_index');
        }

        return $this->render('banque/adresse_client/new.html.twig', [
            'adresse_client' => $adresseClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adresse_client_show", methods={"GET"})
     */
    public function show(AdresseClient $adresseClient): Response
    {
        return $this->render('banque/adresse_client/show.html.twig', [
            'adresse_client' => $adresseClient,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="adresse_client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AdresseClient $adresseClient): Response
    {
        $form = $this->createForm(AdresseClientType::class, $adresseClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adresse_client_index');
        }

        return $this->render('banque/adresse_client/edit.html.twig', [
            'adresse_client' => $adresseClient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adresse_client_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AdresseClient $adresseClient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresseClient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adresseClient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adresse_client_index');
    }
}
