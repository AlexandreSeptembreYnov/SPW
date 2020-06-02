<?php

namespace App\Controller;

use App\Entity\Bien;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use App\Repository\AnnonceRepository;


class AnnonceController extends AbstractController
{
    /**
     * @var AnnonceRepository
     */
    private $repository;

    public function __construct(AnnonceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/biens", name="Annonce.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('Annonce/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/annonces/{slug}-{id}", name="Annonce.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Annonce $Annonce
     * @param Bien $Bien
     * @param string $slug
     * @return Response
     */
    public function show(Annonce $Annonce, string $slug): Response
    {
        if ($Annonce->getSlug() !== $slug) {
            return $this->redirectToRoute('Annonce.show', [
                'id' => $Annonce->getId(),
                'slug' => $Annonce->getSlug()
            ], 301);
        }
        return $this->render('Annonce/show.html.twig', [
            'annonce' => $Annonce,
            'current_menu' => 'Annonces'
        ]);
    }

}
