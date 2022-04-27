<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Entity\Reclamation;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReponseRepository;
use App\Repository\ReclamationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use MercurySeries\FlashyBundle\FlashyNotifier;

class ReponseController extends AbstractController
{

   

    /**
     * @Route("/reponse/deleteRec/{idreclamation}", name="Admin_reclamation_delete_reponse", methods={"POST"})
     */
    public function deleteAdminRecl(FlashyNotifier $flashy, Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reclamation->getIdreclamation(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }
        $flashy->success('reclamation supprimé aves succés!', 'http://your-awesome-link.com');
        return $this->redirectToRoute('Admin_reclamation_index_reponse', [], Response::HTTP_SEE_OTHER);
    }



    /**
     * @Route("/reponse/{idreclamation}", name="Admin_reclamation_show_reponse", methods={"GET"})
     */
    public function showAdmin(Reclamation $reclamation): Response
    {
        return $this->render('reponse/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }


    /**
     * @Route("/reponse/add/{id}", name="rep_add")
     */
    public function addResponse(Reclamation $recl, Reclamation $desc, Request $req, ReclamationRepository $rep, $id, SessionInterface $session)
    {
        $reclamation = $session->get("reclamation", $recl->getIdreclamation());
        $subject = $session->get("subj", $desc->getDescriptionreclamtion());


        $idReclamation = $rep->find($id);
        $em = $this->getDoctrine()->getManager();
        $reponses = new Reponse();
        $reponses->setCreatedAt(new \DateTimeImmutable());
        $recl->setEtatreclamtion('Résolue');
        $form = $this->createForm(ReponseType::class, $reponses);
        $form->add('Add', SubmitType::class);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $reponses = $reponses->setReclamation($idReclamation);
            $em = $this->getDoctrine()->getManager();
            $em->persist($reponses);
            $em->flush();
            $this->addFlash('success', 'Your Response is added successfully');
            return $this->redirectToRoute('reponse_list');
        }

        return $this->render('reponse/addReponse.html.twig', [
            'formA' => $form->createView(),
            'reclamation' => $reclamation,
            'subject' => $subject

        ]);
    }

    /**
     * @Route("reponse/all/list", name="reponse_list")
     */
    public function afficher_reponses(Request $request ): Response
    {
        $reponses = $this->getDoctrine()->getRepository(Reponse::class)->findAll();
       
        return $this->render('reponse/listReponses.html.twig', [
            'tab1' => $reponses,
        ]);
    }

    /**
     * @return Reponse
     * @Route("/response/delete/{id}", name="response_delete")
     */

    public function Delete_reponse($id, ReponseRepository $rep)
    {
        $response = $rep->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($response);
        $em->flush();

        return $this->redirectToRoute('reponse_list');
    }


    /**
     * @Route("reponse/update/{id}", name="reponse_update")
     */
    public function update_reponse(Request $request, $id, ReponseRepository $rep)
    {

        $reponse = $rep->find($id);

        $form = $this->createForm(ReponseType::class, $reponse);

        $form->add('update', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Your Response is added successfully');

            return $this->redirectToRoute('reponse_list');
        }
        return $this->render('reponse/update.html.twig', [
            'formA' => $form->createView(),
        ]);
    }
}
