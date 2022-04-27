<?php

namespace App\Controller;

use App\Entity\Reservationservice;
use App\Entity\Services;
use App\Repository\reservationpackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="app_panier")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $services = $entityManager
            ->getRepository(Services::class)
            ->findAll();
        return $this->render('panier/index.html.twig', [
            'services' => $services,
        ]);
    }


      /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout($stripeSK,reservationpackRepository $reservationpackRepository): Response
    {

      $reservationpacks = $reservationpackRepository->findAll();

      $product = 0 ;
      $data = 0.0;

      foreach ($reservationpacks as $reservationpack) {
        if($reservationpack->getId() ==  5)
          $product = $reservationpack->getIdpack()->getNom();
          $data=$reservationpack->getIdpack()->getPrix();
      }

        \Stripe\Stripe::setApiKey($stripeSK);

        $session = Session::create([
            'line_items' => [[
              'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                  'name' => $product,
                ],
                'unit_amount' => $data,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('success_url',[],
            UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' =>$this->generateUrl('cancel_url',[],
            UrlGeneratorInterface::ABSOLUTE_URL) ,
          ]);
        
          return $this->redirect($session->url,303);
    }


     /**
     * @Route("/success_url", name="success_url")
     */
    public function successUrl(): Response
    {
        return $this->render('panier/success.html.twig');
    }

    
     /**
     * @Route("/cancel_url", name="cancel_url")
     */
    public function cancelUrl(): Response
    {
        return $this->render('payment/cancel.html.twig');
    }
}
 