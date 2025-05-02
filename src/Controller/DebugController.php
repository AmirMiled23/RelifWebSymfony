<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class DebugController extends AbstractController
{
    #[Route('/debug/routes', name: 'debug_routes')]
    public function listRoutes(RouterInterface $router): Response
    {
        $routes = [];
        foreach ($router->getRouteCollection() as $name => $route) {
            $routes[] = [
                'name' => $name,
                'path' => $route->getPath(),
                'methods' => $route->getMethods(),
                'controller' => $route->getDefaults()['_controller'] ?? 'unknown',
            ];
        }
        
        return $this->render('debug/routes.html.twig', [
            'routes' => $routes,
        ]);
    }
}
