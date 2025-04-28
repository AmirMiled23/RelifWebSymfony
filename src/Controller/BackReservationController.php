<?php

namespace App\Controller;

use App\Entity\ReservationMateriel;
use App\Form\ReservationMateriel1Type;
use App\Repository\ReservationMaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/back/reservation')]
final class BackReservationController extends AbstractController
{
    #[Route(name: 'app_back_reservation_index', methods: ['GET'])]
    public function index(ReservationMaterielRepository $reservationMaterielRepository): Response
    {
        return $this->render('back_reservation/index.html.twig', [
            'reservation_materiels' => $reservationMaterielRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationMateriel = new ReservationMateriel();
        $form = $this->createForm(ReservationMateriel1Type::class, $reservationMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materiel = $reservationMateriel->getMateriel();
            $dateDebut = $reservationMateriel->getDateDebut();
            $dateFin = $reservationMateriel->getDateFin();
            $quantite = $reservationMateriel->getQuantite();
            $quantiteDisponible = $materiel->getQuantiteDisponible($dateDebut, $dateFin);
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

                return $this->redirectToRoute('app_back_reservation_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('back_reservation/new.html.twig', [
            'reservation_materiel' => $reservationMateriel,
            'form' => $form,
        ]);
    }

    #[Route('/reservation_materiel/{id_reservation}', name: 'app_back_reservation_show', methods: ['GET'])]
public function show(int $id_reservation, ReservationMaterielRepository $repository): Response
{
    $reservationMateriel = $repository->find($id_reservation);

    if (!$reservationMateriel) {
        throw $this->createNotFoundException('Réservation non trouvée');
    }

    return $this->render('back_reservation/show.html.twig', [
        'reservation_materiel' => $reservationMateriel,
        'nom_materiel' => $reservationMateriel->getMateriel() ? $reservationMateriel->getMateriel()->getNomMateriel() : 'Non spécifié',
    ]);
}


    #[Route('/{id_reservation}/edit', name: 'app_back_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationMateriel $reservationMateriel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationMateriel1Type::class, $reservationMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $materiel = $reservationMateriel->getMateriel();
                $dateDebut = $reservationMateriel->getDateDebut();
                $dateFin = $reservationMateriel->getDateFin();
                $quantite = $reservationMateriel->getQuantite();

                // Exclure la réservation actuelle des vérifications
                $reservationsExistantes = $materiel->getReservationMateriels()->filter(function ($reservation) use ($reservationMateriel) {
                    return $reservation->getIdReservation() !== $reservationMateriel->getIdReservation();
                });

                $quantiteReservee = 0;
                foreach ($reservationsExistantes as $reservation) {
                    if ($dateDebut < $reservation->getDateFin() && $dateFin > $reservation->getDateDebut()) {
                        $quantiteReservee += $reservation->getQuantite();
                    }
                }

                $quantiteDisponible = max(0, $materiel->getQuantiteDispo() - $quantiteReservee);

                if ($quantite > $quantiteDisponible) {
                    $this->addFlash('error', "La réservation dépasse la quantité disponible pour cette période. Quantité disponible : $quantiteDisponible.");
                } else {
                    $entityManager->flush();

                    $this->addFlash('success', 'La réservation a été modifiée avec succès.');
                    return $this->redirectToRoute('app_back_reservation_index', [], Response::HTTP_SEE_OTHER);
                }
            } else {
                $this->addFlash('error', 'Veuillez corriger les erreurs dans le formulaire.');
            }
        }

        return $this->render('back_reservation/edit.html.twig', [
            'reservation_materiel' => $reservationMateriel,
            'form' => $form,
        ]);
    }

    #[Route('/{id_reservation}', name: 'app_back_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationMateriel $reservationMateriel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationMateriel->getId_reservation(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservationMateriel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_reservation_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/search', name: 'app_back_reservation_search', methods: ['GET'])]
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

        return $this->render('back_reservation/index.html.twig', [
            'reservation_materiels' => $reservations,
        ]);
    }
}
