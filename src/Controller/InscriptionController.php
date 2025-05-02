<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Entity\Conference;
use App\Form\InscriptionType;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/inscription')]
final class InscriptionController extends AbstractController
{
    #[Route(name: 'app_inscription_index', methods: ['GET'])]
    public function index(InscriptionRepository $inscriptionRepository): Response
    {
        return $this->render('inscription/index.html.twig', [
            'inscriptions' => $inscriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_inscription_new', methods: ['POST', 'GET'])]
    public function new(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Get form data
        $conferenceId = $request->request->get('conference_id');
        $nom = $request->request->get('nom');
        $prenom = $request->request->get('prenom');
        $email = $request->request->get('email');
        $telephone = $request->request->get('telephone');
        
        // Validate required fields
        if (!$conferenceId || !$nom || !$prenom || !$email || !$telephone) {
            return $this->json(['success' => false, 'message' => 'All fields are required']);
        }
        
        // Get the conference
        $conference = $entityManager->getRepository(Conference::class)->find($conferenceId);
        if (!$conference) {
            return $this->json(['success' => false, 'message' => 'Conference not found']);
        }
        
        try {
            // Create new inscription
            $inscription = new Inscription();
            $inscription->setNom($nom);
            $inscription->setPrenom($prenom);
            $inscription->setEmail($email);
            $inscription->setTelephone($telephone);
            $inscription->setConference($conference);
            // Date is set automatically if using current_timestamp default
            
            // Save to database
            $entityManager->persist($inscription);
            $entityManager->flush();
            
            return $this->json([
                'success' => true,
                'inscriptionId' => $inscription->getId() // Return the new inscription ID
            ]);
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    #[Route('/{id}', name: 'app_inscription_show', methods: ['GET'])]
    public function show(Inscription $inscription): Response
    {
        return $this->render('inscription/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inscription $inscription, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inscription/edit.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscription_delete', methods: ['POST'])]
    public function delete(Request $request, Inscription $inscription, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscription->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($inscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
    }
}
