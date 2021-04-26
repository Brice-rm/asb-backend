<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Services;
use App\Entity\Realisations;

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
    public function index(): Response
    {

        $services = $this->entityManager->getRepository(Services::class)->findAll(); // Doctrine recupère mes Services créé dans EasyAdmin pour les rendres accéssible a ma vue

        $realisations = $this->entityManager->getRepository(Realisations::class)->findAll();

        // dd($realisations); // test de la requete 

        return $this->render('home/index.html.twig', [

            'services' => $services,
            'realisations' => $realisations
        ]);
    }
}
