<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, $id = null): Response
    {
        if ($id == null) {
            $user = new User();
        } else {
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->find($id);
        }


        $form = $this->createForm(UserType::class, $user);
        $formpassword = $this->createForm(UserPasswordType::class, $user);

        // $form = $this->createForm(UserType::class, $user);
        // $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $form->handleRequest($request);
            $formpassword->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();
                $entityManager->persist($user);
            }

            if ($formpassword->isSubmitted() && $formpassword->isValid()) {
                $user = $formpassword->getData();
                $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
                $entityManager->persist($user);
            }

            $entityManager->flush();

            return $this->redirectToRoute('admin-user-edit', ['id' => $user->getId()]);
        }

        return $this->render('security/user/edit.html.twig', array(
            'form' => $form->createView(),
            'formpassword' => $formpassword->createView(),
            'user' => $user
        ));
    }


    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
