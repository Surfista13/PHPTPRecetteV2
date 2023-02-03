<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailsController extends AbstractController
{
    #[Route('/details/{id}', name: 'app_details')]
    public function index(RecetteRepository $recetteRepository, int $id): Response
    {
        $recette = $recetteRepository->find($id);

        return $this->render('details/index.html.twig', [
            'controller_name' => 'DetailsController',
            'details' => $recette
        ]);
    }
}
