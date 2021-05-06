<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\Response;

// SERVICES ET REALISATION //
use App\Entity\Services;
use App\Entity\Realisations;

 // CONTACT //
use App\Classe\Mail;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{

    private $entityManager; // Manager de doctrine

    public function __construct(EntityManagerInterface $entityManager) // creer une fonction avec les functions de doctrine
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(request $request)
    {

        // SERVICES ET REALISATION

        $services = $this->entityManager->getRepository(Services::class)->findAll(); // Doctrine recupère mes Services créé dans EasyAdmin pour les rendres accéssible a ma vue

        $realisations = $this->entityManager->getRepository(Realisations::class)->findAll();

        // dd($realisations); // test de la requete 



        // CONTACT //

        $form = $this->createForm(ContactType::class); // j'appelle mon formulaire
        $form->handleRequest($request); // Analyse la requette de l'utilisateur

        if ($form->isSubmitted() && $form->isValid()) {   // verifie que mon formulaire est été soumis et si il est valide
 
            // dd($form->getData());
            
            // Je recupère les infos du formaulaire pour les envoyer par la suite sur la boite mail du site 
            $content = "Bonjour, </br>Vous avez reçus un message de <strong>".$form->getData()['firstname']." ".$form->getData()['lastname']." "."</strong></br>Adresse email : <strong>".$form->getData()['email']."</strong> </br>Message : ".$form->getData()['content']."</br></br>";             
            $mail = new Mail();
            $mail->send('bricerome77@gmail.com', 'ASB', 'Vous avez reçus une nouvelle demande de contact', $content); // $to_mail , to_name , subject et $content stocker dans ma classe Mail.php
                
        }

        return $this->render('home/index.html.twig', [

            'services' => $services,
            'realisations' => $realisations,
            'form_cont' => $form->createView() // créer une vue de mon form
        ]);
    }
}
