<?php

namespace App\Controller\banque;

use App\Entity\banque\SousCategorie;
use App\Form\Type\banque\SousCategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sous/categorie")
 */
class SousCategorieController extends AbstractController
{
    /**
     * @Route("/", name="sous_categorie_index", methods={"GET"})
     */
    public function index(): Response
    {
        $sousCategories = $this->getDoctrine()
            ->getRepository(SousCategorie::class)
            ->findAll();

        return $this->render('banque/sous_categorie/index.html.twig', [
            'sous_categories' => $sousCategories,
        ]);
    }

    /**
     * @Route("/new", name="sous_categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sousCategorie = new SousCategorie();
        $form = $this->createForm(SousCategorieType::class, $sousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('sous_categorie_index');
        }

        return $this->render('banque/sous_categorie/new.html.twig', [
            'sous_categorie' => $sousCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_categorie_show", methods={"GET"})
     */
    public function show(SousCategorie $sousCategorie): Response
    {
        return $this->render('banque/sous_categorie/show.html.twig', [
            'sous_categorie' => $sousCategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousCategorie $sousCategorie): Response
    {
        $form = $this->createForm(SousCategorieType::class, $sousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_categorie_index');
        }

        return $this->render('banque/sous_categorie/edit.html.twig', [
            'sous_categorie' => $sousCategorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_categorie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SousCategorie $sousCategorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousCategorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_categorie_index');
    }
}
