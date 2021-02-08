<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Header;
use App\Entity\Feature;

class AdjahController extends AbstractController
{
	private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    #[Route('/adjah', name: 'adjah')]
    public function index(): Response
    {
    	$features = $this->entityManager->getRepository(Feature::class )->findAll();
       // dd($products);
         $headers = $this->entityManager->getRepository(Header::class )->findAll();
        return $this->render('adjah/index.html.twig', [
            'headers' => $headers,
            'features'=>$features,
        ]);
    }
}
