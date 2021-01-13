<?php

namespace App\Controller;

use App\Entity\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;

/**
 *  * @Route("/session", name="session_")
 */

class SessionController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }

    /**
     * @Route("/seance", name="session_show", methods={"GET"})
     */
    public function show(): Response
    {
        $session = $this->getDoctrine()
            ->getRepository(Session::class)
            ->findAll();

        return $this->render('session/show.html.twig', [
            'session' => $session,
        ]);
    }
}
