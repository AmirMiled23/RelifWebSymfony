<?php

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Tattali\CalendarBundle\Entity\Event as CalendarEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    private EventRepository $eventRepository;
    private EntityManagerInterface $entityManager;
    public function __construct(EventRepository $eventRepository,EntityManagerInterface $entityManager)
    {
        $this->eventRepository = $eventRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/calendar', name: 'admin_calendar')]
    public function adminCalendar(): Response
    {
        $events = $this->eventRepository->findAll();
        return $this->render('Calendar/admin.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/user/calendar', name: 'user_calendar')]
    public function userCalendar(): Response
    {
        return $this->render('Calendar/user.html.twig');
    }

    public function getCalendarEvents(\DateTimeInterface $start, \DateTimeInterface $end, array $filters = []): iterable
    {
        $events = $this->eventRepository->createQueryBuilder('e')
            ->where('e.date_event BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();

        foreach ($events as $event) {
            yield (new CalendarEvent($event->getNomEvent(), $event->getDateEvent()))
                ->setOptions([
                    'backgroundColor' => 'blue',
                    'borderColor' => 'blue',
                ])
                ->setUrl($this->generateUrl('app_event_show', ['id' => $event->getIdEvent()]));
        }
    }

    #[Route('/user/calendar/events', name: 'user_calendar_events')]
    public function userCalendarEvents(): JsonResponse
    {
        $events = $this->eventRepository->findBy(['assignedToCalendar' => true]);

        $calendarEvents = [];
        foreach ($events as $event) {
            $calendarEvents[] = [
                'title' => $event->getNomEvent(),
                'start' => $event->getDateEvent()->format('Y-m-d H:i:s'),
                'url' => $this->generateUrl('event_show', ['id' => $event->getIdEvent()]),
            ];
        }

        return $this->json($calendarEvents);
    }

    #[Route('/admin/calendar/assign', name: 'admin_assign_events', methods: ['POST'])]
    public function assignEventsToCalendar(Request $request): RedirectResponse
    {
        $eventIds = $request->request->all('event_ids') ?? []; 

        
        $events = $this->eventRepository->findAll();
        foreach ($events as $event) {
            $event->setAssignedToCalendar(in_array($event->getIdEvent(), $eventIds));
            $this->entityManager->persist($event); 
        }

        $this->entityManager->flush(); 

        return $this->redirectToRoute('admin_calendar');
    }
    #[Route('/admin/calendar/events', name: 'admin_calendar_events')]
public function adminCalendarEvents(): JsonResponse
{
    $events = $this->eventRepository->findBy(['assignedToCalendar' => true]);

    $calendarEvents = [];
    foreach ($events as $event) {
        $calendarEvents[] = [
            'title' => $event->getNomEvent(),
            'start' => $event->getDateEvent()->format('Y-m-d H:i:s'),
            'url' => $this->generateUrl('app_event_show', ['id' => $event->getIdEvent()]), // vers /event/{id}
        ];
    }

    return $this->json($calendarEvents);
}

}
