<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Form\Conference1Type;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Log\LoggerInterface;

#[Route('/conference/back')]
final class ConferenceBackController extends AbstractController
{
    #[Route(name: 'app_conference_back_index', methods: ['GET'])]
    public function index(ConferenceRepository $conferenceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $queryBuilder = $conferenceRepository->createQueryBuilder('c');
        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10 // Items per page
        );

        return $this->render('conference_back/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_conference_back_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conference = new Conference();
        $form = $this->createForm(Conference1Type::class, $conference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conference);
            $entityManager->flush();
            $this->addFlash('success', 'Conférence ajoutée avec succès !');
            return $this->redirectToRoute('app_conference_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('conference_back/new.html.twig', [
            'conference' => $conference,
            'form' => $form,
        ]);
    }

    #[Route('/weather', name: 'app_conference_weather', methods: ['POST'])]
    public function getWeather(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $location = $data['location'] ?? null;
        $date = $data['date'] ?? null;

        if (!$location || !$date) {
            return new JsonResponse(['error' => 'Invalid location or date'], Response::HTTP_BAD_REQUEST);
        }

        $apiKey = '34a5ba330480c38a1ab17b0cf2e0f8f3';
        $url = sprintf(
            'https://api.openweathermap.org/data/2.5/forecast?q=%s&appid=%s&units=metric',
            urlencode($location),
            $apiKey
        );

        try {
            $response = @file_get_contents($url);

            if ($response === false) {
                $error = error_get_last();
                throw new \Exception('HTTP request failed: ' . ($error['message'] ?? 'Unknown error'));
            }

            $weather = json_decode($response, true);

            if (!isset($weather['cod']) || $weather['cod'] !== "200") {
                $message = $weather['message'] ?? 'Unknown error';
                throw new \Exception("API error: $message");
            }

            // Match the date exactly (YYYY-MM-DD format)
            $forecast = null;
            foreach ($weather['list'] as $item) {
                if (strpos($item['dt_txt'], $date) === 0) {
                    $forecast = $item;
                    break;
                }
            }

            if (!$forecast) {
                return new JsonResponse(['error' => 'No weather data available for the selected date'], Response::HTTP_NOT_FOUND);
            }

            // Log the forecast data for debugging
            file_put_contents('weather_debug.log', "Forecast Data: " . json_encode($forecast, JSON_PRETTY_PRINT) . "\n", FILE_APPEND);

            // Extra validation for weather and main
            $description = isset($forecast['weather'][0]['description']) ? $forecast['weather'][0]['description'] : null;
            $temperature = isset($forecast['main']['temp']) ? $forecast['main']['temp'] : null;

            if ($description === null || $temperature === null) {
                return new JsonResponse(['error' => 'Incomplete weather data'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            $response = [
                'description' => $description,
                'temperature' => $temperature,
            ];

            return new JsonResponse($response);
        } catch (\Exception $e) {
            // Log the error for debugging
            file_put_contents('weather_error.log', "Error: " . $e->getMessage() . "\nURL: $url\nPayload: " . json_encode($data) . "\n", FILE_APPEND);

            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/events', name: 'app_conference_back_events', methods: ['GET'])]
    public function getEvents(Request $request, ConferenceRepository $conferenceRepository): JsonResponse
    {
        // Basic filtering examples (expand as needed)
        $topic = $request->query->get('topic');
        $speaker = $request->query->get('speaker');
        $location = $request->query->get('location');
        $typesString = $request->query->get('types'); // Get 'types' as a string

        // Split the comma-separated string into an array, handle empty/null case
        $typesArray = ($typesString !== null && $typesString !== '') ? explode(',', $typesString) : [];

        $filters = [
            'topic' => $topic,
            'speaker' => $speaker,
            'location' => $location,
            'types' => $typesArray, // Use the manually split array
        ];

        // Remove null/empty filters before passing to repository (optional, but good practice)
        $activeFilters = array_filter($filters, function ($value) {
            // Keep 'types' even if it's an empty array after splitting
            return $value !== null && $value !== '' || is_array($value);
        });

        // IMPORTANT: You need to implement the findWithFilters method in ConferenceRepository
        // Pass the filtered array to the repository method
        $conferences = $conferenceRepository->findWithFilters($activeFilters);

        $events = array_map(function (Conference $conference) {
            // Determine category/color (example logic)
            $category = strtolower($conference->getTheme() ?? 'general');
            $color = match ($category) {
                'workshop' => '#ff9f89',
                'talk' => '#89cff0',
                'keynote' => '#fafa89',
                default => '#a9a9a9',
            };

            return [
                'id' => $conference->getId(),
                'title' => $conference->getTitre(),
                'start' => $conference->getDateConference()?->format('Y-m-d H:i:s'), // Include time if available
                'end' => $conference->getDateConference()?->format('Y-m-d H:i:s'), // Adjust if you have end dates/times
                'allDay' => false, // Assuming conferences have specific times
                'color' => $color,
                'extendedProps' => [
                    'speaker' => $conference->getPresenteur(),
                    'location' => $conference->getLieu(),
                    'theme' => $conference->getTheme(),
                    // 'description' => $conference->getDescription(), // Add description if available in your entity
                    'category' => $category,
                ]
            ];
        }, $conferences);

        return new JsonResponse($events);
    }

    #[Route('/update-date/{id}', name: 'app_conference_back_update_date', methods: ['POST'])]
    public function updateEventDate(Request $request, Conference $conference, EntityManagerInterface $entityManager, LoggerInterface $logger): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $start = $data['start'] ?? null;
        // $end = $data['end'] ?? null; // If you track end dates

        if (!$start) {
            return new JsonResponse(['status' => 'error', 'message' => 'Missing start date'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $newStartDate = new \DateTime($start);
            $conference->setDateConference($newStartDate);
            // if ($end) { $conference->setEndDate(new \DateTime($end)); } // If applicable

            $entityManager->flush();
            $logger->info(sprintf('Updated conference %d start date to %s', $conference->getId(), $start));
            return new JsonResponse(['status' => 'success']);

        } catch (\Exception $e) {
            $logger->error(sprintf('Error updating conference %d date: %s', $conference->getId(), $e->getMessage()));
            return new JsonResponse(['status' => 'error', 'message' => 'Could not update date: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function getWeatherAdvice(string $description): string
    {
        if (stripos($description, 'rain') !== false || stripos($description, 'shower') !== false) {
            return 'Attention : Risque de pluie. Préparez un parapluie.';
        } elseif (stripos($description, 'clear') !== false) {
            return 'Bonne journée pour voyager. Profitez du soleil !';
        } elseif (stripos($description, 'snow') !== false) {
            return 'Attention : Risque de neige. Soyez prudent sur les routes.';
        } elseif (stripos($description, 'storm') !== false || stripos($description, 'thunder') !== false) {
            return 'Attention : Risque d\'orage. Voyagez avec prudence.';
        } elseif (stripos($description, 'cloud') !== false) {
            return 'Le temps est nuageux. Préparez-vous à des changements possibles.';
        } else {
            return 'Voyagez prudemment et vérifiez les conditions locales.';
        }
    }

    #[Route('/{id}', name: 'app_conference_back_show', methods: ['GET'])]
    public function show(Conference $conference): Response
    {
        return $this->render('conference_back/show.html.twig', [
            'conference' => $conference,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conference_back_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conference $conference, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Conference1Type::class, $conference);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Conférence modifiée avec succès !');
            return $this->redirectToRoute('app_conference_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('conference_back/edit.html.twig', [
            'conference' => $conference,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conference_back_delete', methods: ['POST'])]
    public function delete(Request $request, Conference $conference, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conference->getId(), $request->request->get('_token'))) {
            $entityManager->remove($conference);
            $entityManager->flush();
            $this->addFlash('success', 'Conférence supprimée avec succès !');
        }

        return $this->redirectToRoute('app_conference_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
