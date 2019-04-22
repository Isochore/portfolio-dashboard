<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Projet;
use App\Repository\ProjetRepository;

class ProjController extends AbstractController
{
    /**
     * @Route("/proj", name="proj")
     */
    // public function index()
    // {
    //     $repo = $this->getDoctrine()->getRepository(Projet::class);
    //     $projets = $repo->findAll();
    //     return $this->render('proj/index.html.twig', [
    //         'controller_name' => 'ProjController',
    //         'projets' => $projets
    //     ]);
    // }


    /**
     * @Route("/", name="index")
     */
    public function index(ProjetRepository $repo)
    {
        // $repo = $this->getDoctrine()->getRepository(Projet::class);
        $projets = $repo->findAll();
        return $this->render('proj/home.html.twig', [
            'controller_name' => 'ProjController',
            'projets' => $projets
        ]);
    }

    /**
     * @Route("/home", name="home")
     */
    public function home(ProjetRepository $repo)
    {
        // $repo = $this->getDoctrine()->getRepository(Projet::class);
        $projets = $repo->findAll();
        return $this->render('proj/home.html.twig', [
            'controller_name' => 'ProjController',
            'projets' => $projets
        ]);
    }

    // /**
    //  * @Route("/admin", name="admin")
    //  */
    // public function admin()
    // {
    //     // $repo = $this->getDoctrine()->getRepository(Projet::class);
    //     // $projets = $repo->findAll();
    //     return $this->render('proj/admin.html.twig', [
    //         'controller_name' => 'ProjController'
    //     ]);
    // }

    
}
