<?php


namespace App\Controller;


use App\Entity\Group;
use App\Entity\Session;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/groupe", name="group_")
 */
class GroupController extends AbstractController
{
    /**
     * @Route ("/{groupName}", name="show")
     */
    public function show(string $groupName)

    {
        $group = $this->getDoctrine()
            ->getRepository(Group::class)
            ->findOneBy(['name' => $groupName]);

        if (!$group) {
            throw $this->createNotFoundException(
                'Désolé, nous n\'avons pas trouvé ce groupe.'
            );
        }
        $users  = $this->getDoctrine()
            ->getRepository(User::class)
            ->findByGroup($groupName);
        $sessions  = $this->getDoctrine()
            ->getRepository(Session::class)
            ->findByGroup($groupName);
        return $this->render('groupes/show.html.twig', [
            'group' => $group,
            'users' => $users,
            'sessions' => $sessions

        ]);

    }
}
