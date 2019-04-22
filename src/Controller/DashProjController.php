<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Projet;
use App\Entity\Technology;
use App\Repository\ProjetRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;


class DashProjController extends AbstractController
{
    // /**
    //  * @Route("/dashboard", name="dashboard")
    //  */
    // public function default(ProjetRepository $repo)
    // {
    //     $projets = $repo->findAll();
    //     return $this->render('dash_proj/show_proj.html.twig', [
    //         'controller_name' => 'DashProjController',
    //         'projets' => $projets
    //     ]);
    // }

    /**
     * @Route("/dashboard/projets", name="dashproj")
     * @Route("/dashboard", name="dashboard")
     * 
     */
    public function show(ProjetRepository $repo)
    {
        $projets = $repo->findAll();
        return $this->render('dash_proj/show_proj.html.twig', [
            'controller_name' => 'DashProjController',
            'projets' => $projets
        ]);
    }



    /**
     * @Route("/dashboard/projets/create", name="create_projets")
     * @Route("/dashboard/projets/{id}/edit", name="edit_projets")
     */
    public function form(Projet $projet = null, Request $request, ObjectManager $manager)
    {
        if(!$projet) {
            $projet = new Projet();
        }
        $form = $this->createFormBuilder($projet)
                     ->add('title')
                     ->add('content')
                     ->add('image')
                     ->add('link')
                     ->add('git')
                     ->add('technology', EntityType::class, [
                         'class' => Technology::class,
                         'choice_label' => 'name',
                         'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('technology')
                            ->orderBy('technology.name', 'ASC');
                            },
                         'multiple' => true,
                         'expanded' => true
                     ])
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($projet);
            $manager->flush();

            return $this->redirectToRoute('show_projet', ['id' => $projet->getId()]);
        }

        return $this->render('dash_proj/create_proj.html.twig', [
            'formProjet' => $form->createView(),
            'editMode' => $projet->getId() !== null
        ]);
    }


    /**
     * @Route("/dashboard/projets/{id}/delete", name="delete_projets")
     */
    public function delete(Projet $projet = null, Request $request, ObjectManager $manager)
    {

            $manager->remove($projet);
            $manager->flush();

            return $this->redirectToRoute('dashproj', ['id' => $projet->getId()]);

    }


    /**
     * @Route("/dashboard/projets/{id}", name="show_projet")
     * 
     */
    public function show_one($id)
    {
        $repo = $this->getDoctrine()->getRepository(Projet::class);
        $projet = $repo->find($id);

        return $this->render('dash_proj/show_one.html.twig', [
            'projet' => $projet,
        ]);
    }

}
