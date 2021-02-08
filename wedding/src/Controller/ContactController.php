<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Classe\Mail;


class ContactController extends AbstractController
{
	private $entityManager;
	public function __construct(EntityManagerInterface $entityManager)
	{
	  $this->entityManager=$entityManager;
	}
    #[Route('/contact', name: 'contact')]
    public function index(Request $request): Response
    { 
    	//dd('here');
    	

    	$notification=null;
    	$contact=new Contact();
    	$form=$this->createForm(ContactType::class,$contact);
    	 $form->handleRequest($request);//recup data in form and check it

    	  if ($form->isSubmitted() && $form->isValid()) {
    	  	$reference=uniqid();
    	  	$to_name=$contact->getNom();
    	  	$contact->setReference($reference);
           	$contact->setCreatedAt(new \DateTime());
           	$this->entityManager->persist($contact);
            $this->entityManager->flush();
              //envoi du mail after inscription
              $notification="Merci de nous avoir contacter notre Team,Vous recevrez un mail avec la refence de votre demande";
              $subject="Confirmation de la recepetion de votre demande réference: ".$reference;
              $content=$to_name.", la TEAM-MAYA se fera le plaisir de repondre à votre préoccupation dans un plus bref délai, merci à bientot.";
           
            $mail= new Mail();
            $mail->sendContact($contact->getEmail(),$to_name, $subject,$content);

    	  }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'notification'=>$notification,
        ]);
    }
}
