<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeControllController extends AbstractController {
    #[Route('/admin', name: 'app_backoffice')]
    public function backoffice(): Response
    {
        return $this->render('back.html.twig');
    }
    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        return $this->render('backofficehome.html.twig');
    }

}


