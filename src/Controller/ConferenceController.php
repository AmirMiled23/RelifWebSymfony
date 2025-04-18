<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Form\ConferenceType;
use App\Repository\ConferenceRepository;
use App\Repository\ResourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/conference')]
final class ConferenceController extends AbstractController
{
    #[Route(name: 'app_conference_index', methods: ['GET'])]
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        return $this->render('conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_conference_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ResourceRepository $resourceRepository): Response
    {
        $conference = new Conference();
        $resources = $resourceRepository->findAll();
        $form = $this->createForm(ConferenceType::class, $conference, [
            'resources' => $resources
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conference);
            $entityManager->flush();

            return $this->redirectToRoute('app_conference_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conference/new.html.twig', [
            'conference' => $conference,
            'form' => $form,
            'resources' => $resources,
        ]);
    }

    #[Route('/{id}', name: 'app_conference_show', methods: ['GET'])]
    public function show(Conference $conference): Response
    {
        return $this->render('conference/show.html.twig', [
            'conference' => $conference,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conference_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conference $conference, EntityManagerInterface $entityManager, ResourceRepository $resourceRepository): Response
    {
        $resources = $resourceRepository->findAll();
        $form = $this->createForm(ConferenceType::class, $conference, [
            'resources' => $resources
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_conference_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conference/edit.html.twig', [
            'conference' => $conference,
            'form' => $form,
            'resources' => $resources,
        ]);
    }

    #[Route('/{id}', name: 'app_conference_delete', methods: ['POST'])]
    public function delete(Request $request, Conference $conference, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conference->getId(), $request->getPayload()->getString('_token'))) {
            // Remove all inscriptions related to this conference
            foreach ($conference->getInscriptions() as $inscription) {
                $entityManager->remove($inscription);
            }
            $entityManager->remove($conference);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_conference_index', [], Response::HTTP_SEE_OTHER);
    }
}
