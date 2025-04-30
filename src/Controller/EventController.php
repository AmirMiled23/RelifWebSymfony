<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Service\WeatherService;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route('/event')]
final class EventController extends AbstractController{
    private HttpClientInterface $client;
    private FormFactoryInterface $formFactory;

    public function __construct(HttpClientInterface $client, FormFactoryInterface $formFactory)
    {
        $this->client = $client;
        $this->formFactory = $formFactory;
    }
    #[Route(name: 'app_event_index', methods: ['GET'])]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/event/{id}/edit', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId_event(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/event/showclient',name: 'app_event_public', methods: ['GET'])]
    public function list(EventRepository $eventRepository, Request $request): Response
    {
        $titre = $request->query->get('titre');
        $ville = $request->query->get('ville');
    
        $events = $eventRepository->createQueryBuilder('e');
    
        if ($titre) {
            $events->andWhere('e.nom_event LIKE :titre')
                   ->setParameter('titre', '%' . $titre . '%');
        }
    
        if ($ville) {
            $events->andWhere('e.villes LIKE :ville')
                   ->setParameter('ville', '%' . $ville . '%');
        }
    
        $result = $events->getQuery()->getResult();

    return $this->render('event/homeevenement.html.twig', [
        'events' => $result,
    ]);
    }

    #[Route('/event/showEvent/{id}', name: 'event_show', methods: ['GET'])]
    public function showevent(Event $event): Response
    {
        $ville = $event->getVilles();
        $geoResponse = $this->client->request('GET', 'https://geocoding-api.open-meteo.com/v1/search', [
            'query' => [
                'name' => $ville,
                'count' => 1, 
            ]
        ]);

        $geoData = $geoResponse->toArray();
        $lat = $geoData['results'][0]['latitude'];
    $lng = $geoData['results'][0]['longitude'];
       
        $response = $this->client->request('GET', 'https://api.open-meteo.com/v1/forecast', [
            'query' => [
                'latitude' => $lat,
                'longitude' => $lng,
                'current_weather' => 'true',
                'hourly' => 'relative_humidity_2m',
                'timezone' => 'Europe/Paris',
            ]
        ]);
        $weather = $response->toArray();

      
        $currentTemp = $weather['current_weather']['temperature'];
        $currentWind = $weather['current_weather']['windspeed'];
    
        
        $now = (new \DateTime())->format('Y-m-d\TH:00');
        $hourIndex = array_search($now, $weather['hourly']['time']);
        $currentHumidity = $hourIndex !== false ? $weather['hourly']['relative_humidity_2m'][$hourIndex] : null;
    
       
        return $this->render('event/showclient.html.twig', [
            'event' => $event,
            'currentTemp' => $currentTemp,
        'currentWind' => $currentWind,
        'currentHumidity' => $currentHumidity,
        ]);
    }





}
