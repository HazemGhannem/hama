<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;

/**
 * @Route("/avis")
 */
class AvisController extends AbstractController
{
    /**
     * @Route("/", name="app_avis_index", methods={"GET"})
     */
    public function index(Request $request, EntityManagerInterface $entityManager,PaginatorInterface $pagiantor): Response
    {
        $donnee = $entityManager->getRepository(Avis::class)->findAll();
        $avis = $pagiantor->paginate($donnee, $request->query->getInt('page',1),5);


        return $this->render('avis/index.html.twig', [
            'avis' => $avis,
        ]);
    }

    /**
     * @Route("/avisAdmin", name="Admin_avis_index", methods={"GET"})
     */
    public function indexAdmin(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $pagiantor): Response
    {
        $donnee = $entityManager->getRepository(Avis::class)->findAll();
        $avis = $pagiantor->paginate($donnee, $request->query->getInt('page', 1), 5);


        return $this->render('avisAdmin/index.html.twig', [
            'avis' => $avis,
        ]);
    }

    /**
     * @Route("/new", name="app_avis_new", methods={"GET", "POST"})
     */
    public function new(FlashyNotifier $flashy, Request $request, EntityManagerInterface $entityManager): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avi);
            $entityManager->flush();

            $flashy->success('avis ajouté aves succés!', 'http://your-awesome-link.com');
            return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avis/new.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idavis}", name="app_avis_show", methods={"GET"})
     */
    public function show(Avis $avi): Response
    {
        return $this->render('avis/show.html.twig', [
            'avi' => $avi,
        ]);
    }

    /**
     * @Route("/avisAdmin/{idavis}", name="Admin_avis_show", methods={"GET"})
     */
    public function showAdmin(Avis $avi): Response
    {
        return $this->render('avisAdmin/show.html.twig', [
            'avi' => $avi,
        ]);
    }

    /**
     * @Route("/{idavis}/edit", name="app_avis_edit", methods={"GET", "POST"})
     */
    public function edit(FlashyNotifier $flashy, Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $flashy->success('avis modifié aves succés!', 'http://your-awesome-link.com');
            return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idavis}", name="app_avis_delete", methods={"POST"})
     */
    public function delete(FlashyNotifier $flashy ,Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getIdavis(), $request->request->get('_token'))) {
            $entityManager->remove($avi);
            $entityManager->flush();
        }
        $flashy->success('avis supprimé aves succés!', 'http://your-awesome-link.com');
        return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/avisAdmin/{idavis}", name="Admin_avis_delete", methods={"POST"})
     */
    public function deleteAdmin(FlashyNotifier $flashy, Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getIdavis(), $request->request->get('_token'))) {
            $entityManager->remove($avi);
            $entityManager->flush();
        }
        $flashy->success('avis supprimé aves succés!', 'http://your-awesome-link.com');
        return $this->redirectToRoute('Admin_avis_index', [], Response::HTTP_SEE_OTHER);
    }
    

    
}
