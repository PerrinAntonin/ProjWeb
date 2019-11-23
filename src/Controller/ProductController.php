<?php


namespace App\Controller;
use App\Entity\Product;

use App\Form\CreateProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

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
     * @Route("/shop",name="shop")
     **/
    public function categories() {
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_ANONYMOUSLY ')) {
            dd("connecetd");
        }

        return $this->render('categories.html.twig', []);
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

    /**
     * @Route("/publishproduct", name="publishproduct")
     */
    public function register(Request $request, EntityManagerInterface $em, Security $security)
    {
        $product = new Product();
        $form = $this->createForm(CreateProductFormType::class,$product);

        $form->handleRequest($request); // On récupère le formulaire envoyé dans la requête


        if ($form->isSubmitted() && $form->isValid()) { // on véfifie si le formulaire est envoyé et si il est valide


            $article = $form->getData(); // On récupère l'article associé

            $article->setUserId($security->getUser());
            $article->setPublishdate(New \DateTime());

            $em->persist($article); // on le persiste
            $em->flush(); // on save

            return $this->redirectToRoute('index'); // Hop redirigé et on sort du controller
        }
        if( !$security->isGranted('IS_AUTHENTICATED_FULLY') ){
            return $this->redirectToRoute('app_login');
        }
        return $this->render('publishproduct.html.twig', ['form' => $form->createView()]); // on envoie ensuite le formulaire au template

    }
}