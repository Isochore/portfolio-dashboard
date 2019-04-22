<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Technology;
use App\Repository\TechnoRepository;

class TechnoController extends AbstractController
{
    /**
     * @Route("/dashboard/techno", name="techno")
     */
    public function show(TechnoRepository $repo)
    {
        $technos = $repo->findAll();
        return $this->render('techno/show_techno.html.twig', [
            'controller_name' => 'TechnoController',
            'technos' => $technos
        ]);
    }

      /**
     * @Route("/dashboard/techno/create", name="create_techno")
     */
    public function form(Technology $techno = null, Request $request, ObjectManager $manager)
    {
        if(!$techno) {
            $techno = new Technology();
        }
        $form = $this->createFormBuilder($techno)
                     ->add('name')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($techno);
            $manager->flush();

            return $this->redirectToRoute('techno');
        }

        // dump($techno);

        return $this->render('techno/create_techno.html.twig', [
            'formTechno' => $form->createView(),
        ]);
    }
    

    /**
     * @Route("/dashboard/techno/{id}/delete", name="delete_techno")
     */
    public function delete(Technology $techno = null, Request $request, ObjectManager $manager)
    {

            $manager->remove($techno);
            $manager->flush();

            return $this->redirectToRoute('techno', ['id' => $techno->getId()]);

    }


}
