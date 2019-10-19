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
        return $this->render('index.html.twig', []);
    }

    /**
     * @Route("/product/{productId}",name="productDetails")
     **/
    public function productDetails() {
        return $this->render('productDetails.html.twig', []);
    }

}