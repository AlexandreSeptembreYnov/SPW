<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\PropositionAchat;
use App\Entity\Vendeur;
use App\Form\BienType;
use App\Repository\BienRepository;
use App\Repository\PropositionAchatRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{


    /**
     * @Route("/profile", name="Client")
     * @return Response
     */
    public function index()
    {

        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    /**
     * @Route("/profile/bien/add", name="AjoutBien")
     * @param Request $request
     * @param BienRepository $repository
     * @param ObjectManager $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function newBien(Request $request, BienRepository $repository, ObjectManager $em)
    {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($bien);
            $em->flush();
            $this->addFlash('success', 'Bien créé avec succès');
            return $this->redirectToRoute('profile/bien');
        }

        return $this->render('Bien/new.html.twig', [
            'bien' => $bien,
            'form'     => $form->createView()
        ]);
    }

    /**
     * @Route("/profile/bien", name="Bien")
     * @param BienRepository $repository
     * @return Response
     */
    public function indexBien(BienRepository $repository)
    {
        $user= $this->get('security.context')->getToken()->getUser();
        $biens = $repository->findByVendeur($user->getId());
        return $this->render('bien/index.html.twig', compact('biens'));
    }
}
