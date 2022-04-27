<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\Services1Type;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/services")
 */
class ServicesController extends AbstractController
{
    /**
     * @Route("/", name="app_services_index", methods={"GET"})
     */
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('services/index.html.twig', [
            'services' => $servicesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_services_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ServicesRepository $servicesRepository, EntityManagerInterface $entityManager): Response
    {
        $service = new Services();
        $form = $this->createForm(Services1Type::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $request->files->get('services1')['image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            $service->setImage($filename);
            $entityManager->persist($service);
            $entityManager->flush();
            return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('services/new.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_services_show", methods={"GET"})
     */
    public function show(Services $service): Response
    {
        return $this->render('services/show.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_services_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Services $service, ServicesRepository $servicesRepository , EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Services1Type::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('services1')['image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            $service->setImage($filename);
            $entityManager->persist($service);
            $entityManager->flush();
            return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('services/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_services_delete", methods={"POST"})
     */
    public function delete(Request $request, Services $service, ServicesRepository $servicesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $service->getId(), $request->request->get('_token'))) {
            $servicesRepository->remove($service);
        }

        return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
    }
}
