<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/",name="index")
     **/
    public function index() {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_ANONYMOUSLY ')) {
            dd("connecetd");
        }

        return $this->render('index.html.twig', []);
    }

    /**
     * @Route("/product/{productId}",name="productDetails")
     **/
    public function productDetails() {
        return $this->render('productDetails.html.twig', []);
    }
    /**
     * @Route("/maps/{ville}/{pays}",name="maps")
     **/
    public function maps($ville, $pays) {
        return $this->render('maps.html.twig', [
            "ville" => $ville,
            "pays" =>$pays
        ]);
    }
    /**
     * @Route("/sendmail/{name}",name="sendmail")
     **/
    public function sendMail($name, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('maiscetaitsur@gmail.com')
            ->setTo('kraknistic.43@gmail.com')
            ->setBody(
                //$this->renderView(
                    'Email Envoyé a ' . $name
                    /*
                // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    ['name' => $name]
                )
                //'text/html'*/
            );

        $mailer->send($message);

        return new Response('email envoyé');
    }
}