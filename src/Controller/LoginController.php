<?php

namespace App\Controller;

use App\Form\CreateAccountFormType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
    /**
     * @Route("/Create", name="CreateAccount")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(CreateAccountFormType::class);

        $form->handleRequest($request); // On récupère le formulaire envoyé dans la requête


        //dd("ddd");
        if ($form->isSubmitted() && $form->isValid()) { // on véfifie si le formulaire est envoyé et si il est valide
            $article = $form->getData(); // On récupère l'article associé
            dd($article);
            $em->persist($article); // on le persiste
            $em->flush(); // on save

            return $this->redirectToRoute('app_login'); // Hop redirigé et on sort du controller
        }
        return $this->render('create.html.twig', ['form' => $form->createView()]); // on envoie ensuite le formulaire au template

    }



}
