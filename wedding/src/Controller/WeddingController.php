<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Header;
use App\Entity\Feature;

class WeddingController extends AbstractController
{
	private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    #[Route('/wedding', name: 'wedding')]
    public function index(): Response
    {
    	$features = $this->entityManager->getRepository(Feature::class )->findAll();
       // dd($products);
         $headers = $this->entityManager->getRepository(Header::class )->findAll();
        // dd($headers);
        return $this->render('wedding/index.html.twig', [
            'headers' => $headers,
            'features'=>$features,
        ]);
    }
}
