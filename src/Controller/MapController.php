<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MapController extends AbstractController
{
    private $client;

    // Injection du service HTTP client
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getGeolocation(Request $request)
    {
        $address = $request->query->get('address'); // Adresse envoyée en paramètre
        
        // Remplace "VOTRE_CLE_API" par ta clé API Google Maps
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=VOTRE_CLE_API';

        // Faire une requête HTTP GET vers l'API Google Maps
        $response = $this->client->request('GET', $url);

        // Récupérer la réponse JSON
        $data = $response->toArray();

        // Retourner la réponse au format JSON
        return new JsonResponse($data);
    }
}
