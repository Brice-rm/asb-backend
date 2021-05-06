<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{

    private $entityManager; // Manager de doctrine

    public function __construct(EntityManagerInterface $entityManager) // creer une fonction avec les functions de doctrine
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User(); // j'appelle ma classe user
        $form = $this->createForm(RegisterType::class, $user); //j'appelle mon formulaire ou j'y inject mon Style et mes data

        $form->handleRequest($request); // Recupère la requette de l'utilisateur

        if($form->isSubmitted() && $form->isValid()){ // verifie que mon formulaire est été soumis et si il est valide


            $user = $form->getData(); // injecte dans user les données de l'utilisateur
            $password = $encoder->encodePassword($user, $user->getPassword()); // permet de récuperer le mdp et l'encoder
            
            $user->setPassword($password); // réinjecte le mdp encoder dans User

            $this->entityManager->persist($user); // Doctrine fige la data
            $this->entityManager->flush();// Doctrine prend la data figé et l'enregistre dans la table User
        }


        return $this->render('register/index.html.twig',[
            'form' => $form->createView() // creer la vue de mon form
        ]);
    }
}
