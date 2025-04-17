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

                return $this->redirectToRoute('app_reservation_materiel_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('reservation_materiel/new.html.twig', [
            'reservation_materiel' => $reservationMateriel,
            'form' => $form,
        ]);
    }

    #[Route('/{id_reservation}', name: 'app_reservation_materiel_show', methods: ['GET'])]
    public function show(ReservationMateriel $reservationMateriel): Response
    {
        return $this->render('reservation_materiel/show.html.twig', [
            'reservation_materiel' => $reservationMateriel,
        ]);
    }

    #[Route('/{id_reservation}/edit', name: 'app_reservation_materiel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationMateriel $reservationMateriel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationMaterielType::class, $reservationMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_materiel/edit.html.twig', [
            'reservation_materiel' => $reservationMateriel,
            'form' => $form,
        ]);
    }

    #[Route('/{id_reservation}', name: 'app_reservation_materiel_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationMateriel $reservationMateriel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationMateriel->getId_reservation(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservationMateriel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_materiel_index', [], Response::HTTP_SEE_OTHER);
    }
}
