<?php


namespace App\Controller;


use App\Entity\Film;
use App\Entity\Group;
use App\Entity\Session;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/session", name="session_")
 */
class SessionController extends AbstractController
{
    /**
     * @Route ("/{sessionName}", name="show")
     */
    public function show(string $sessionName)

    {
        $session = $this->getDoctrine()
            ->getRepository(Session::class)
            ->findOneBy(['schedule' => $sessionName]);

        if (!$session) {
            throw $this->createNotFoundException(
                'Désolé, nous n\'avons pas trouvé cette séance.'
            );
        }
        $film  = $this->getDoctrine()
            ->getRepository(Film::class)
            ->findBySession($sessionName);
        $group  = $this->getDoctrine()
            ->getRepository(Group::class)
            ->findBySession($sessionName);
        return $this->render('sessions/show.html.twig', [
            'groups' => $group,
            'films' => $film,
            'session' => $session

        ]);

    }
}
