<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\InviteType;
use App\Form\ListInviteType;
use App\Entity\Invite;
use Symfony\Component\HttpFoundation\Request;
use App\Classe\Mail;
use Dompdf\Dompdf;
use Dompdf\Options;

class InviteController extends AbstractController
{

	private $entityManager;
	public function __construct(EntityManagerInterface $entityManager)
	{
	  $this->entityManager=$entityManager;
	}
    #[Route('/invite', name: 'invite')]
    public function index(Request $request): Response
    { 
       
        $notification=null;
    	$pass=uniqid();
    	$created_at=date("Y-m-d H:i:s");
    	//dd($created_at);
          $invite= new Invite();
    	   $form=$this->createForm(InviteType::class,$invite);

          $form->handleRequest($request);//recup data in form and check it

           if ($form->isSubmitted() && $form->isValid()) {
            
           	$invite->setPassWedding($pass);
           	$invite->setCreatedAt(new \DateTime());
           	//dump($invite->getCreatedAt());
           //	dd($form->getData());

           	//check if email and contact nover use
           		$search_email =$this->entityManager->getRepository(Invite::class)->findOneByEmail($invite->getEmail());

             	//$email=$search_email->getEmail();
             	//$phone=$search_email->getPhone();

             	if(!$search_email)
             	{
             		$to_name=$invite->getNom()." ".$invite->getPrenom();
             		 $this->entityManager->persist($invite);
                  $this->entityManager->flush();
                     //envoi du mail after inscription
              $notification="Merci d'avoir confirmer votre présence,Vous recevrez un mail avec votre PassWedding";
              $subject="Confirmation de votre invitation PassWedding:".$pass;
              $content=$to_name.", le duo parfait tient à vous remercier pour la confirmation votre présence à son mariage.<br>";
              $content.="Les couleures sont le <b>bleu</b> et le <b>saumon</b>, ci-dessous votre Carte d'invitation";
           
            $mail= new Mail();
            $mail->send($invite->getEmail(),$to_name, $subject,$content);

             		
             	}else{

             		$notification="Email ou contact déja utilisé, merci de revoir vos informations !";
             	
             	}
           }


        return $this->render('invite/index.html.twig', [
            'form' => $form->createView(),
            'notification'=>$notification,
        ]);
    }
 
  /**
  * generation de pdf
  */
    #[Route('/getpdf', name: 'pdf_get')]
    public function createPDF(Request $request)
    {
      $notification=null;
     // $invite= new Invite();
      // retreive all records from db
      //$lien=$request->lien;
      $form=$this->createForm(ListInviteType::class);
      $form->handleRequest($request);//recup data in form and check it
       // dd($lien);

      if ($form->isSubmitted() && $form->isValid()) {
        $lien=$form->get('lien')->getData();
      //  dd($lien);
        $data = $this->entityManager->getRepository(Invite::class)->findListeInviteByLien($lien);

        if (!$data) {
         $this->addFlash('notice',"Aucun invité enregistré pour le moment sous ce lien,merci :) ");
        }else{
          $this->addFlash('notice',"Detail de la liste dans le fichier pdf,merci  :) ");

          // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

          // instantiate and use the dompdf class
          $dompdf = new Dompdf($pdfOptions);

           //  dd($data);
          // Retrieve the HTML generated in our twig file
          $html = $this->renderView('invite/showlist.html.twig', [
            'lien' =>$lien,
            'data'=>$data,
        ]);

        //  dd( $data);

          $dompdf->loadHtml($html);

         // (Optional) Setup the paper size and orientation
          $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
          $dompdf->render();

             // Output the generated PDF to Browser
          $name=$lien."_13-mars-2021";
          $dompdf->stream($name,[
            "Attachment" => false
        ]);
           
         // dump($data);
        }

      }

       return $this->render('invite/mypdf.html.twig', [
            'form' => $form->createView(),
            'notification'=>$notification,

        ]);


    }


  /**
  *obtention de la liste invite
  */
    #[Route('/showpdf', name: 'pdf_show')]
    public function listeInvitePDF(Request $request)
    {


    }



}
