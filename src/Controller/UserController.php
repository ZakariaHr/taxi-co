<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="users_list")
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function getUsers(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class)
            ->findAll();

        return $this->render('user/list.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/user/{user}", name="user_rides")
     * @param User $user
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function getuserRides(User $user, ManagerRegistry $doctrine): Response
    {
        $rides = $doctrine->getRepository(User::class)->getUserRides($user);

        return $this->render('user/rides.html.twig', ['user' => $user, 'rides' => $rides]);
    }
}