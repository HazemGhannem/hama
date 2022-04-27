<?php

namespace App\Controller;

use App\Entity\PropertySearch1;
use App\Entity\Reservationservice;
use App\Form\PropertySearchType1Type;
use App\Form\ReservationserviceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/reservationservice")
 */
class ReservationserviceController extends AbstractController
{
     /**
     * @Route("/admin", name="adminindex", methods={"GET"})
     */
    public function indexAdmin(EntityManagerInterface $entityManager): Response
    {
        

        return $this->render('Admin/index.html.twig');
    }




    /**
     * @Route("/", name="app_reservationservice_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $search = new PropertySearch1();
        $form = $this->createForm(PropertySearchType1Type::class, $search);
        $form->handleRequest($request);

      



        $reservationservices = $entityManager
            ->getRepository(Reservationservice::class)
            ->findAll();

        return $this->render('reservationservice/index.html.twig', [
            'reservationservices' => $reservationservices,
            'form'  => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="app_reservationservice_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationservice = new Reservationservice();
        $form = $this->createForm(ReservationserviceType::class, $reservationservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationservice);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationservice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationservice/new.html.twig', [
            'reservationservice' => $reservationservice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_reservationservice_show", methods={"GET"})
     */
    public function show(Reservationservice $reservationservice): Response
    {
        return $this->render('reservationservice/show.html.twig', [
            'reservationservice' => $reservationservice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_reservationservice_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Reservationservice $reservationservice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationserviceType::class, $reservationservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservationservice_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservationservice/edit.html.twig', [
            'reservationservice' => $reservationservice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_reservationservice_delete", methods={"POST"})
     */
    public function delete(Request $request, Reservationservice $reservationservice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationservice->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservationservice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservationservice_index', [], Response::HTTP_SEE_OTHER);
    }

  
}
