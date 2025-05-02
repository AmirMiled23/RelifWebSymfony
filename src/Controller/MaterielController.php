<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Entity\ReservationMateriel; // Ajout de l'import manquant
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Service\SmsService;
use Psr\Log\LoggerInterface;
use App\Service\PostmarkService;
use App\Service\MailService;
use App\Service\CalendarLinkGenerator; // Ajout de l'import manquant

#[Route('/materiel')]
final class MaterielController extends AbstractController
{
    #[Route(name: 'app_materiel_index', methods: ['GET'])]
    public function index(MaterielRepository $materielRepository): Response
    {
        return $this->render('materiel/index.html.twig', [
            'materiels' => $materielRepository->findAll(),
        ]);
    }
    #[Route('/search', name: 'app_materiel_search', methods: ['GET'])]
    public function search(Request $request, MaterielRepository $materielRepository): Response
    {
        $criteria = [
            'nom' => $request->query->get('nom'),
            'description' => $request->query->get('description'),
            'quantiteMin' => $request->query->get('quantiteMin'),
            'quantiteMax' => $request->query->get('quantiteMax'),
        ];

        $sort = $request->query->get('sort', 'asc'); // Par défaut, tri croissant

        $materiels = $materielRepository->findByCriteria($criteria, $sort);

        return $this->render('materiel/index.html.twig', [
            'materiels' => $materiels,
        ]);
    }

    #[Route('/new', name: 'app_materiel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $materiel = new Materiel();
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($materiel);
            $entityManager->flush();

            $this->addFlash('success', 'Le matériel a été ajouté avec succès.');

            return $this->redirectToRoute('app_materiel_index', [], Response::HTTP_SEE_OTHER);
        } else if ($form->isSubmitted()) {
            $this->addFlash('error', 'Veuillez corriger les erreurs dans le formulaire.');
        }

        return $this->render('materiel/new.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }

    #[Route('/{id_materiel}', name: 'app_materiel_show', requirements: ['id_materiel' => '\d+'], methods: ['GET'])]
    public function show(int $id_materiel, MaterielRepository $materielRepository): Response
    {
        $materiel = $materielRepository->find($id_materiel);

        if (!$materiel) {
            throw $this->createNotFoundException('Materiel not found');
        }

        return $this->render('materiel/show.html.twig', [
            'materiel' => $materiel,
        ]);
    }

    #[Route('/{id_materiel}/edit', name: 'app_materiel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('materiel/edit.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }

    #[Route('/{id_materiel}', name: 'app_materiel_delete', methods: ['POST'])]
    public function delete(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materiel->getIdMateriel(), $request->request->get('_token'))) {
            $entityManager->remove($materiel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_materiel_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/materiel/pdf', name: 'app_materiel_pdf', methods: ['GET'])]
    public function generatePdf(MaterielRepository $materielRepository): Response
    {
        // Configure Dompdf
        $pdfOptions = new Options();
        $pdfOptions->setIsRemoteEnabled(true);
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        // Fetch all materiels
        $materiels = $materielRepository->findAll();

        // Render the view
        $html = $this->renderView('materiel/pdf.html.twig', [
            'materiels' => $materiels,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Output the generated PDF
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="materiels_front.pdf"',
        ]);
    }

    #[Route('/reserve', name: 'app_materiel_reserve', methods: ['GET','POST'])]
    public function reserve(Request $request, EntityManagerInterface $entityManager, SmsService $smsService, LoggerInterface $logger): Response
    {
        $logger->info("✅ La méthode reserve() est bien atteinte !");
        $materielId = $request->request->get('materiel_id');
        $quantite = (int) $request->request->get('quantite');
        $dateDebut = new \DateTime($request->request->get('date_debut'));
        $dateFin = new \DateTime($request->request->get('date_fin'));

        $receiverPhoneNumber = $_ENV['SMS_RECEIVER_NUMBER'];

        $materiel = $entityManager->getRepository(Materiel::class)->find($materielId);

        if (!$materiel) {
            return $this->json(['error' => 'Matériel non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        if (!$materiel->isAvailableForReservation($dateDebut, $dateFin, $quantite)) {
            return $this->json(['error' => 'Quantité demandée non disponible.'], Response::HTTP_BAD_REQUEST);
        }

        // Ici, on suppose que tu as une entité ReservationMateriel bien définie.
        $reservation = new \App\Entity\ReservationMateriel();
        $reservation->setMateriel($materiel);
        $reservation->setDateDebut($dateDebut);
        $reservation->setDateFin($dateFin);
        $reservation->setQuantiteReservee($quantite);

        $entityManager->persist($reservation);
        $entityManager->flush();

        // Message SMS
        $message = sprintf(
            "Réservation confirmée : %s, %d unité(s), du %s au %s.",
            $materiel->getNomMateriel(),
            $quantite,
            $dateDebut->format('d/m/Y'),
            $dateFin->format('d/m/Y')
        );

        // Envoi SMS via le service
        try {
            dd("Envoi SMS", $receiverPhoneNumber, $message);
            $smsService->sendSms($receiverPhoneNumber, $message);
        } catch (\Exception $e) {
            return $this->json(['warning' => 'Réservation réussie, mais l\'envoi du SMS a échoué.'], Response::HTTP_OK);
        }

        return $this->json(['success' => 'Réservation effectuée et SMS envoyé.'], Response::HTTP_OK);
    }

    #[Route('/materiel/email-test', name: 'app_materiel_email_test', methods: ['GET'])]
    public function sendReservationConfirmationEmail(PostmarkService $postmarkService): Response
    {
        $toEmail = 'khalil.bergaoui@esprit.tn'; // À remplacer par l'e-mail de l'utilisateur réel
        $subject = 'Confirmation de votre réservation';
        $message = 'Votre réservation a bien été confirmée. Merci de votre confiance.';

        $success = $postmarkService->sendEmail($toEmail, $subject, $message);

        if ($success) {
            return new Response('Email envoyé avec succès.');
        }

        return new Response('Échec lors de l’envoi de l’email.', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    #[Route('/materiel/email-test', name: 'app_materiel_email_test', methods: ['GET', 'POST'])]
    public function sendTestEmail(MailService $mailService): Response
    {
        $toEmail = 'khalil.bergaoui@esprit.tn'; // Remplacez par l'adresse e-mail du destinataire
        $subject = 'Test d\'envoi d\'e-mail';
        $content = '<p>Ceci est un e-mail de test envoyé depuis Symfony Mailer.</p>';

        $success = $mailService->sendEmail($toEmail, $subject, $content);

        if ($success) {
            return new Response('E-mail envoyé avec succès.');
        }

        return new Response('Échec lors de l\'envoi de l\'e-mail.', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    #[Route('/reservation/{id}/calendar', name: 'app_reservation_calendar')]
    public function calendarLinks(ReservationMateriel $reservation, CalendarLinkGenerator $calendar): Response
    {
        return $this->render('reservation/calendar_links.html.twig', [
            'links' => $calendar->generateLinks($reservation),
            'reservation' => $reservation
        ]);
    }
}