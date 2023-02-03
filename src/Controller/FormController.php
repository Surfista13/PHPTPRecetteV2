<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/Form', name: 'app_form')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $recette = new Recette();
        $recetteForm = $this->createForm(RecetteType::class, $recette);

        $recetteForm->handleRequest(($request));

        if($recetteForm->isSubmitted()){
            $em->persist($recette);
            $em->flush();
        }

        dump($recetteForm);

        return $this->render('form/index.html.twig', [
            'form'=>$recetteForm
        ]);
    }

}
