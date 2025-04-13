<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeControllController extends AbstractController {
    #[Route('/', name: 'app_home_controll')]
    public function index(): Response
    {
        return $this->render('homepage.html.twig');
    }
   /* #[Route('/', name: 'app_home_controll')]
    public function index(): Response
    {
        return $this->render('homepage.html.twig');
    }*/ 

}


