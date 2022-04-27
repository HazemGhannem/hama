<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Form\RegistrationType;
use App\Entity\Utilisateur;
use App\Form\Utilisateur1Type;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\utilisateurRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/")
 */
class UtilisateurController extends AbstractController
{
    // /**
    //      * @Route("/inscription", name="utilisateur_registration" , methods={"GET", "POST"})
    //      */
    //     public function registration(Request $request,  UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $manager)  {

    //         $utilisateur = new Utilisateur ();
    //         $form = $this->createForm(RegistrationType::class,$utilisateur);

    //         $form-> handleRequest($request);

    //         if ($form-> isSubmitted() && $form->isValid() ) {

    //             $utilisateur->setPassword(
    //                 $userPasswordEncoder->encodePassword(
    //                         $utilisateur,
    //                         $form->get('password')->getData()
    //                     )
    //                 );

    //                 $utilisateur->setRepeatpassword(
    //                     $userPasswordEncoder->encodePassword(
    //                             $utilisateur,
    //                             $form->get('repeatpassword')->getData()
    //                         )
    //                     );


    //             $manager->persist($utilisateur);
    //             $manager->flush();

    //             return $this->redirectToRoute('app_home_page');
    //         }

    //         return $this->render('utilisateur/registration.html.twig', [
    //             'form' => $form -> createView()
    //         ]);
    //     }







    //  /**
    //  * @Route("/login", name="utilisateur_login" , methods={"GET", "POST"})
    //  */

    // public function connexion(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $manager)


    // { 

    //     $utilisateur = new Utilisateur ();
    //     $form = $this->createForm(LoginType::class,$utilisateur);

    //     $form-> handleRequest($request);

    //     // if($utilisateur->getBloquer()==1)
    //     //  { echo "<div class='p-3 mb-2 bg-danger'>ce compte est bloquer</div>";}
    //     if ($form-> isSubmitted() && $form->isValid() ) {
    //         $utilisateur->setPassword(
    //             $userPasswordEncoder->encodePassword(
    //                     $utilisateur,
    //                     $form->get('password')->getData()
    //                 )
    //             );
    //          $manager->persist($utilisateur);
    //         $manager->flush();
    //         return $this->redirectToRoute('app_home_page');
    //     }

    //         return $this->render('utilisateur/login.html.twig', [
    //             'form' => $form -> createView()
    //         ]);


    //  }














    /**
     * @Route("/utilisateur", name="app_utilisateur_index", methods={"GET"})
     */

    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'utilisateur' => $utilisateurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_utilisateur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UtilisateurRepository $utilisateurRepository, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(Utilisateur1Type::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $request->files->get('utilisateur1')['image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            $utilisateur->setImage($filename);
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateur/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }




    /**
     * @Route("/{id}", name="app_utilisateur_show", methods={"GET"})
     */
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_utilisateur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Utilisateur $utilisateur, UtilisateurRepository $utilisateurRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Utilisateur1Type::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get('utilisateur1')['image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            $utilisateur->setImage($filename);
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_utilisateur_delete", methods={"POST"})
     */
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }



    /**
     * @Route("/{id}/bloquer", name="app_utilisateur_bloquer", methods={"GET", "POST"})
     */
    public function bloquer(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $utilisateur->setBloquer(1);
        $entityManager->flush();
        return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/{id}/debloquer", name="app_utilisateur_debloquer", methods={"GET", "POST"})
     */
    public function debloquer(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $utilisateur->setBloquer(0);
        $entityManager->flush();
        return $this->redirectToRoute('app_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
