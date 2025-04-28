<?php

namespace App\Controller;

use App\Entity\ReservationMateriel;
use App\Form\ReservationMaterielType;
use App\Repository\ReservationMaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reservation/materiel')]
final class ReservationMaterielController extends AbstractController
{
    #[Route(name: 'app_reservation_materiel_index', methods: ['GET'])]
    public function index(ReservationMaterielRepository $reservationMaterielRepository): Response
    {
        return $this->render('reservation_materiel/index.html.twig', [
            'reservation_materiels' => $reservationMaterielRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_materiel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationMateriel = new ReservationMateriel();
        $form = $this->createForm(ReservationMaterielType::class, $reservationMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$reservationMateriel->getMateriel()) {
                $this->addFlash('error', 'Le matériel associé à cette réservation a été supprimé.');
                return $this->redirectToRoute('app_reservation_materiel_index');
            }

            $materiel = $reservationMateriel->getMateriel();
            $dateDebut = $reservationMateriel->getDateDebut();
            $dateFin = $reservationMateriel->getDateFin();
            $quantite = $reservationMateriel->getQuantiteReservee();

            $quantiteDisponible = $materiel->getAvailableQuantityForPeriod($dateDebut, $dateFin);
            $nextAvailableDate = $materiel->getNextAvailableDateForFullQuantity($dateDebut, $dateFin);

            if ($quantite > $quantiteDisponible) {
                $message = "La réservation dépasse la quantité disponible pour cette période. Quantité disponible : $quantiteDisponible.";
                if ($nextAvailableDate) {
                    $message .= " Vous pourrez réserver toutes les quantités à partir du " . $nextAvailableDate->format('d-m-Y') . ".";
                }
                $this->addFlash('error', $message);
            } else {
                $entityManager->persist($reservationMateriel);
                $entityManager->flush();

                $this->addFlash('success', 'La réservation a été ajoutée avec succès.');
                return $this->redirectToRoute('app_reservation_materiel_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('reservation_materiel/new.html.twig', [
            'reservation_materiel' => $reservationMateriel,
            'form' => $form,
        ]);
    }

    #[Route('/reservation_materiel/{id_reservation}', name: 'app_reservation_materiel_show')]
    public function show(int $id_reservation, ReservationMaterielRepository $repository): Response
    {
        $reservationMateriel = $repository->find($id_reservation);
    
        if (!$reservationMateriel) {
            throw $this->createNotFoundException('Reservation not found');
        }
    
        return $this->render('reservation_materiel/show.html.twig', [
            'reservation_materiel' => $reservationMateriel,
        ]);
    }

    #[Route('/{id_reservation}/edit', name: 'app_reservation_materiel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationMateriel $reservationMateriel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationMaterielType::class, $reservationMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                if (!$reservationMateriel->getMateriel()) {
                    $this->addFlash('error', 'Le matériel associé à cette réservation a été supprimé.');
                    return $this->redirectToRoute('app_reservation_materiel_index');
                }

                $materiel = $reservationMateriel->getMateriel();
                $dateDebut = $reservationMateriel->getDateDebut();
                $dateFin = $reservationMateriel->getDateFin();
                $quantite = $reservationMateriel->getQuantiteReservee();

                // Exclure la réservation actuelle des vérifications
                $reservationsExistantes = $materiel->getReservationMateriels()->filter(function ($reservation) use ($reservationMateriel) {
                    return $reservation->getIdReservation() !== $reservationMateriel->getIdReservation();
                });

                $quantiteReservee = 0;
                foreach ($reservationsExistantes as $reservation) {
                    if ($dateDebut < $reservation->getDateFin() && $dateFin > $reservation->getDateDebut()) {
                        $quantiteReservee += $reservation->getQuantiteReservee();
                    }
                }

                $quantiteDisponible = max(0, $materiel->getQuantiteDispo() - $quantiteReservee);

                if ($quantite > $quantiteDisponible) {
                    $this->addFlash('error', "La réservation dépasse la quantité disponible pour cette période. Quantité disponible : $quantiteDisponible.");
                } else {
                    $entityManager->flush();

                    $this->addFlash('success', 'La réservation a été modifiée avec succès.');
                    return $this->redirectToRoute('app_reservation_materiel_index', [], Response::HTTP_SEE_OTHER);
                }
            } else {
                $this->addFlash('error', 'Veuillez corriger les erreurs dans le formulaire.');
            }
        }

        return $this->render('reservation_materiel/edit.html.twig', [
            'reservation_materiel' => $reservationMateriel,
            'form' => $form,
        ]);
    }

    #[Route('/{id_reservation}', name: 'app_reservation_materiel_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationMateriel $reservationMateriel, EntityManagerInterface $entityManager): Response
    {
        if (!$reservationMateriel->getMateriel()) {
            $this->addFlash('error', 'Le matériel associé à cette réservation a été supprimé.');
            return $this->redirectToRoute('app_reservation_materiel_index');
        }

        if ($this->isCsrfTokenValid('delete'.$reservationMateriel->getId_reservation(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservationMateriel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_materiel_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/search', name: 'app_reservation_materiel_search', methods: ['GET'])]
    public function search(Request $request, ReservationMaterielRepository $reservationMaterielRepository): Response
    {
        $criteria = [
            'nomMateriel' => $request->query->get('nomMateriel'),
            'dateDebut' => $request->query->get('dateDebut'),
            'dateFin' => $request->query->get('dateFin'),
            'quantiteMin' => $request->query->get('quantiteMin'),
            'quantiteMax' => $request->query->get('quantiteMax'),
        ];

        $sort = $request->query->get('sort', 'asc'); // Par défaut, tri croissant

        $reservations = $reservationMaterielRepository->findByCriteria($criteria, $sort);

        return $this->render('reservation_materiel/index.html.twig', [
            'reservation_materiels' => $reservations,
        ]);
    }
}