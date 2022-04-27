<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Repository\ReclamationRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;


/**
 * @Route("/reclamation")
 */
class ReclamationController extends AbstractController
{
    /**
     * @Route("/", name="app_reclamation_index", methods={"GET"})
     */
    public function index(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $pagiantor): Response
    {
        $donnees = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();
        $reclamations = $pagiantor->paginate($donnees, $request->query->getInt('page', 1), 5);

        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    /**
     * @Route("/reclamationAdmin/", name="Admin_reclamation_index", methods={"GET"})
     */
    public function indexAdmin(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamations = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();

        return $this->render('reclamationAdmin/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    /**
     * @Route("/new", name="app_reclamation_new", methods={"GET", "POST"})
     */
    public function new(FlashyNotifier $flashy, Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = new Reclamation();
        $user = $this->getDoctrine()->getRepository(Utilisateur::class)->find(1);
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file= $form->get('imagereclamtion')->getData();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('uploads_directory'),$filename);
            $reclamation->setImagereclamtion($filename);

            
            
            
            $reclamation->setetatreclamtion("Non traitée");

            $entityManager->persist($reclamation);
           
            $entityManager->flush();
            $flashy->success('reclamation ajouté aves succés!', 'http://your-awesome-link.com');
            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
           
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idreclamation}", name="app_reclamation_show", methods={"GET"})
     */
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    /**
     * @Route("/reclamationAdmin/{idreclamation}", name="Admin_reclamation_show", methods={"GET"})
     */
    public function showAdmin(Reclamation $reclamation): Response
    {
        return $this->render('reclamationAdmin/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }


    /**
     * @Route("/{idreclamation}/edit", name="app_reclamation_edit", methods={"GET", "POST"})
     */
    public function edit(FlashyNotifier $flashy, Request $request, Reclamation $reclamation,$idreclamation, EntityManagerInterface $entityManager): Response
    {
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->find($idreclamation);
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file= $form->get('imagereclamtion')->getData();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('uploads_directory'),$filename);
            $reclamation->setImagereclamtion($filename);
            $entityManager->flush();
            $flashy->success('reclamation modifié aves succés!', 'http://your-awesome-link.com');
            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idreclamation}/delete", name="app_reclamation_delete")
     */
    public function delete(FlashyNotifier $flashy, Request $request,$idreclamation, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $reclamation = $this->getDoctrine()->getRepository(Reclamation::class)->find($idreclamation);
        $em = $this->getDoctrine()->getManager();
        $em->remove($reclamation);
        $em->flush();
       
        return $this->redirectToRoute('app_reclamation_index');
    }

    /**
     * @Route("/reclamationAdmin/{idreclamation}", name="Admin_reclamation_delete", methods={"POST"})
     */
    public function deleteAdminRecl(FlashyNotifier $flashy, Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reclamation->getIdreclamation(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }
        $flashy->success('reclamation supprimé aves succés!', 'http://your-awesome-link.com');
        return $this->redirectToRoute('Admin_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
    // BACK RECLAMATION


     /**
     * @Route("/rec/all", name="reclamation_index", methods={"GET"})
     */
    public function indexx(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $pagiantor): Response
    {
        $donnees = $entityManager
            ->getRepository(Reclamation::class)
            ->findAll();
        $reclamations = $pagiantor->paginate($donnees, $request->query->getInt('page', 1), 5);

        return $this->render('reclamation/backrec/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }
    /**
     * @Route("/listreclamation/{idreclamation}", name="reclamation_show", methods={"GET"})
     */
    public function showw(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/backrec/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }



    /**
     * @Route("/admin/stat", name="stats")
     */
    public function statistiques(ReclamationRepository $reclamationRepository)
    { $reclamation = $reclamationRepository->findAll();
       $repository = $this->getDoctrine()->getRepository(Reclamation::class);
       $count= $repository->createQueryBuilder('u')
            ->select('count(u.etatreclamtion)')
            ->groupby('u.etatreclamtion')
            ->getQuery()
            ->getResult();
            
            $countdate= $repository->createQueryBuilder('a')
            ->select('(a.etatreclamtion)')
            ->groupby('a.etatreclamtion')
            ->getQuery()
            ->getResult();
        foreach($reclamation as $reclamation){
            
            $var[] = $reclamation->getEtatreclamtion();
            
        }
            for ($i = 0; $i < count($count); ++$i){
                
                $count1[] = $count[$i][1] ;  
                $countdate1[] = $countdate[$i][1];
            }
        return $this->render('reclamation/stats.html.twig', [ 
            'date' => json_encode($var),
            'count1' => json_encode($count1),
            'countdate1' => json_encode($countdate1),
            
          
            
        ]);   
    }

    


    
}
