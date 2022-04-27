<?php

namespace App\Controller;

use App\Repository\reservationpackRepository;
use App\Repository\reservationserviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestataire", name="app_prestataire")
     */
    public function index(reservationpackRepository $reservationpackRepository): Response
    {

        $reservationpacks = $reservationpackRepository->findAll();

        $labels = [];
        $data = [];

        foreach ($reservationpacks as $reservationpack) {
            $labels[] = $reservationpack->getDate();
            $data[]=$reservationpack->getPrixrespack();
        }

       


        return $this->render('prestataire/index.html.twig', [
            'controller_name' => 'PrestataireController',
            'date' => $labels,
            'donnee' => $data
        ]);
    }


     /**
     * @Route("/prestataire", name="app_prestataire")
     */
    public function sommeReservations(reservationpackRepository $reservationpackRepository, reservationserviceRepository $reservationserviceRepository): Response
    {
        $reservationpacks = $reservationpackRepository->findAll();
        $reservationservice = $reservationserviceRepository->findAll();

        
        $sommepack = 0.0;
        $sommeservice = 0.0;
        $somme = 0.0;

        foreach ($reservationpacks as $reservationpack) {
        
            $sommepack+=$reservationpack->getPrixrespack();
        }

        foreach ($reservationservice as $reservationservice) {
        
            $sommeservice+=$reservationservice->getPrixresserv();
        }

        $somme += $sommepack + $sommeservice;

        return $this->render('prestataire/index.html.twig', [
            'controller_name' => 'PrestataireController',
           'somme' =>  $somme
        ]);
    }
}
