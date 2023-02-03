<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ListeController extends AbstractController
{
    #[Route('/liste', name: 'app_liste')]
    public function index(RecetteRepository $recetteRepository, EntityManagerInterface $em): Response
    {
        $recette = $recetteRepository->lister();
        dump($recette);
        return $this->render('liste/index.html.twig', [
            'controller_name' => 'ListeController',
            'listeRecettes' => $recette
        ]);
    }

    #[Route('/modifFavori/{id}', name: 'app_modif_fav')]
    public function ModifFav(RecetteRepository $recetteRepository,$id,EntityManagerInterface $entityManager, Request $request): Response
    {
        $recette = $recetteRepository->find($id);
       $recette->setEstFavori(!$recette->isEstFavori());
       $entityManager->persist($recette);
       $entityManager->flush();
       $cookies = $request->cookies;
       if($cookies->get('tri') == 'nom'){
           return $this->redirectToRoute('app_tri_nom');
        }else{
           return $this->redirectToRoute('app_tri_favoris');
       }

    }

    #[Route('/triParNom', name: 'app_tri_nom')]
    public function triNom(RecetteRepository $recetteRepository): Response
    {
        $val = 'nom';
        $response = new Response();
        $response->headers->setCookie(new Cookie('tri', $val,time() + (365 * 24 * 60 * 60)));
        $response->send();

        $liste = $recetteRepository ->findBy([],['nom'=>'ASC']);
        return $this->render('liste/index.html.twig', [
            'controller_name' => 'ListeController',
            'listeRecettes' => $liste
        ]);
    }

    #[Route('/triParFavoris', name: 'app_tri_favoris')]
    public function triFavoris(RecetteRepository $recetteRepository): Response
    {
        $val = 'favoris';
        $response = new Response();
        $response->headers->setCookie(new Cookie('tri', $val,time() + (365 * 24 * 60 * 60)));
        $response->send();


        $liste = $recetteRepository ->findBy([],['est_favori'=>'ASC']);
        return $this->render('liste/index.html.twig', [
            'controller_name' => 'ListeController',
            'listeRecettes' => $liste
        ]);
    }


}
