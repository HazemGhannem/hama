<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Repository\reservationpackRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="app_payment")
     */
    public function index(): Response
    {
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }

  

}

