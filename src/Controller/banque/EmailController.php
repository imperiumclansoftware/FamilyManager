<?php

namespace App\Controller\banque;

use App\Entity\banque\Email;
use App\Form\Type\banque\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/email")
 */
class EmailController extends AbstractController
{
    /**
     * @Route("/", name="email_index", methods={"GET"})
     */
    public function index(): Response
    {
        $emails = $this->getDoctrine()
            ->getRepository(Email::class)
            ->findAll();

        return $this->render('banque/email/index.html.twig', [
            'emails' => $emails,
        ]);
    }

    /**
     * @Route("/new", name="email_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $email = new Email();
        $form = $this->createForm(EmailType::class, $email);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($email);
            $entityManager->flush();

            return $this->redirectToRoute('email_index');
        }

        return $this->render('banque/email/new.html.twig', [
            'email' => $email,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="email_show", methods={"GET"})
     */
    public function show(Email $email): Response
    {
        return $this->render('banque/email/show.html.twig', [
            'email' => $email,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="email_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Email $email): Response
    {
        $form = $this->createForm(EmailType::class, $email);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('email_index');
        }

        return $this->render('banque/email/edit.html.twig', [
            'email' => $email,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="email_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Email $email): Response
    {
        if ($this->isCsrfTokenValid('delete'.$email->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($email);
            $entityManager->flush();
        }

        return $this->redirectToRoute('email_index');
    }
}
