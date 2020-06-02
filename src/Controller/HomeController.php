<?php

namespace App\Controller;

use App\Entity\AnnonceSearch;
use App\Form\AnnonceSearchType;
use App\Repository\AnnonceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param AnnonceRepository $repository
     * @return Response
     */
    public function index(AnnonceRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $search = new AnnonceSearch();
        $form = $this->createForm(AnnonceSearchType::class, $search);
        $form->handleRequest($request);

        $annonces = $paginator->paginate($repository->Lastest($search),
            $request->query->getInt('page',1),12);

        return $this->render('home/index.html.twig', [
            'Annonces' => $annonces,
            'form' =>$form->createView()
        ]);
    }
}
