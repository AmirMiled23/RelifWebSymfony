<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Form\Conference1Type;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/conference/back')]
final class ConferenceBackController extends AbstractController
{
    #[Route(name: 'app_conference_back_index', methods: ['GET'])]
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        return $this->render('conference_back/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
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
        if ($this->isCsrfTokenValid('delete'.$conference->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($conference);
            $entityManager->flush();
            $this->addFlash('success', 'Conférence supprimée avec succès !');
        }

        return $this->redirectToRoute('app_conference_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
