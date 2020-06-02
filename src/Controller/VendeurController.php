<?php

namespace App\Controller;


use App\Entity\Bien;
use App\Form\BienType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VendeurController extends AbstractController
{
    /**
     * @Route("/vendeur", name="vendeur")
     */
    public function index()
    {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        return $this->render('vendeur/index.html.twig', [
            'controller_name' => 'VendeurController',
        ]);
    }
    public function bien()
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
}

