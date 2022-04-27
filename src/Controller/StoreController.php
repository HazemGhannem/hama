<?php

namespace App\Controller;

use App\Repository\PacksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{


    /**
     * @Route("/store", name="app_store")
     */
    public function index(PacksRepository $packsRepository): Response
    {
        return $this->render('store/index.html.twig', [
            'packs' => $packsRepository->findAll(),
        ]);
    }
}
