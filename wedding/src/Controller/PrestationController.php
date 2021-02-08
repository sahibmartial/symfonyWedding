<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationController extends AbstractController
{
    #[Route('/prestation', name: 'prestation')]
    public function index(): Response
    {
    	$this->addFlash('notice',"Bientôt nos presations seront disponible :) ");

        return $this->render('prestation/index.html.twig');
    }
}
