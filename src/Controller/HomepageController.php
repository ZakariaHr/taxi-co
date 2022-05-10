<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="taxi_co_homepage")
     */
    public function homepage(): Response
    {
        return $this->render('homepage/homepage.html.twig');
    }
}