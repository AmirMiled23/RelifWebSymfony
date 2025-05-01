<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    

    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(Request $request, ReclamationRepository $reclamationRepository): Response
    {
        $search = $request->query->get('search');
    
        $reclamations = $reclamationRepository->findBySearchQuery($search);
    
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }
    
    
    #[Route('/export/{format}', name: 'app_reclamation_export', methods: ['GET'])]
    public function export(string $format, ReclamationRepository $reclamationRepository): Response
    {
        if ($format === 'csv') {
            // StreamedResponse for CSV export
            $response = new StreamedResponse(function () use ($reclamationRepository) {
                $handle = fopen('php://output', 'w');
    
                // Add CSV headers
                fputcsv($handle, ['ID', 'Titre', 'Type', 'Status', 'Description']);
    
                // Fetch reclamations and write to CSV
                $reclamations = $reclamationRepository->findAll();
                foreach ($reclamations as $reclamation) {
                    fputcsv($handle, [
                        $reclamation->getIdReclamation(),
                        $reclamation->getTitre(),
                        $reclamation->getType(),
                        $reclamation->getStatus(),
                        $reclamation->getDescription(),
                    ]);
                }
    
                fclose($handle);
            });
    
            // Set headers for CSV download
            $response->headers->set('Content-Type', 'text/csv');
            $response->headers->set('Content-Disposition', 'attachment; filename="reclamations.csv"');
    
            return $response;
        }
    
        throw $this->createNotFoundException('Format not supported');
    }
    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer,
        \App\Service\OffensiveSpeechDetector $detector // Inject the service
    ): Response {
        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);
        $toxicityMessage = null;
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifie si le texte est offensant
            $description = $reclamation->getDescription();
            $isOffensive = $detector->isOffensive($description);
    
            if ($isOffensive) {
                // Add the toxicity message
                $toxicityMessage = 'La description contient un langage inapproprié. Veuillez reformuler votre message.';
            } else {
                // Manually set the created_at field
                $reclamation->setCreatedAt(new \DateTime());
                // Set the default status
                $reclamation->setStatus('Pending');
    
                // Persist reclamation to the database
                $entityManager->persist($reclamation);
                $entityManager->flush();
    
                // Send confirmation email to the user
                $email = (new Email())
                    ->from('jaafer.bbj@gmail.com')  // Replace with your email
                    ->to($reclamation->getEmail())
                    ->subject('Confirmation of your reclamation')
                    ->text('Thank you for your reclamation! We will get back to you soon.')
                    ->html('<p>Thank you for your reclamation! We will get back to you soon.</p>');
    
                $mailer->send($email);
    
                return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
            }
        }
    
        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
            'toxicityMessage' => $toxicityMessage,  // Pass the message to Twig
        ]);
    }
    

    #[Route('/{id_reclamation}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id_reclamation}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id_reclamation}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reclamation->getIdReclamation(), $request->request->get('_token'))) {
            $entityManager->remove($reclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/update-status/{id_reclamation}', name: 'app_reclamation_update_status', methods: ['POST'])]
    public function updateStatus(int $id_reclamation, Request $request, EntityManagerInterface $entityManager): Response
    {
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id_reclamation);

        if (!$reclamation) {
            throw $this->createNotFoundException('Réclamation non trouvée.');
        }

        $newStatus = $request->request->get('status');

        if (in_array($newStatus, ['Resolved', 'Rejected'])) {
            $reclamation->setStatus($newStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reclamation_index');
    }

 



}