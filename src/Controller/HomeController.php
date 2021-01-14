<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Session;
use App\Entity\User;
use App\Form\SessionType;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $addGroup = $this->getUser();
        $form = $this->createForm(UserType::class, $addGroup);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addGroup);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }

        $user=$this->getUser();
        $newGroups = $this->getDoctrine()
            ->getRepository(Group::class)
            ->findAll();
        return $this->render('home/index.html.twig',[
            'user'=>$user, 'new_groups' => $newGroups,
             "form" => $form->createView(),
        ]);
    }


}
