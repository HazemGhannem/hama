<?php

namespace App\Controller;

use App\Entity\Packs;
use App\Form\Packs1Type;
use App\Repository\PacksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/packs")
 */
class PacksController extends AbstractController
{
    /**
     * @Route("/", name="app_packs_index", methods={"GET"})
     */
    public function index(PacksRepository $packsRepository): Response
    {
        return $this->render('packs/index.html.twig', [
            'packs' => $packsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_packs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PacksRepository $packsRepository, EntityManagerInterface $entityManager): Response
    {
        $pack = new Packs();
        $form = $this->createForm(Packs1Type::class, $pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $request->files->get('packs1')['image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            $pack->setImage($filename);
            $entityManager->persist($pack);
            $entityManager->flush();
            return $this->redirectToRoute('app_packs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('packs/new.html.twig', [
            'pack' => $pack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_packs_show", methods={"GET"})
     */
    public function show(Packs $pack): Response
    {
        return $this->render('packs/show.html.twig', [
            'pack' => $pack,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_packs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Packs $pack, PacksRepository $packsRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Packs1Type::class, $pack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('packs1')['image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            $pack->setImage($filename);
            $entityManager->persist($pack);
            $entityManager->flush();
            return $this->redirectToRoute('app_packs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('packs/edit.html.twig', [
            'pack' => $pack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_packs_delete", methods={"POST"})
     */
    public function delete(Request $request, Packs $pack, PacksRepository $packsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $pack->getId(), $request->request->get('_token'))) {
            $packsRepository->remove($pack);
        }

        return $this->redirectToRoute('app_packs_index', [], Response::HTTP_SEE_OTHER);
    }
}
