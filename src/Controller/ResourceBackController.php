<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Form\Resource1Type;
use App\Repository\ResourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/resource/back')]
final class ResourceBackController extends AbstractController
{
    #[Route(name: 'app_resource_back_index', methods: ['GET'])]
    public function index(ResourceRepository $resourceRepository): Response
    {
        return $this->render('resource_back/index.html.twig', [
            'resources' => $resourceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_resource_back_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $resource = new Resource();
        $form = $this->createForm(Resource1Type::class, $resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($resource);
            $entityManager->flush();
            $this->addFlash('success', 'Resource ajoutée avec succès !');
            return $this->redirectToRoute('app_resource_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('resource_back/new.html.twig', [
            'resource' => $resource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resource_back_show', methods: ['GET'])]
    public function show(Resource $resource): Response
    {
        return $this->render('resource_back/show.html.twig', [
            'resource' => $resource,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_resource_back_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Resource $resource, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Resource1Type::class, $resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Resource modifiée avec succès !');
            return $this->redirectToRoute('app_resource_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('resource_back/edit.html.twig', [
            'resource' => $resource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resource_back_delete', methods: ['POST'])]
    public function delete(Request $request, Resource $resource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resource->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($resource);
            $entityManager->flush();
            $this->addFlash('success', 'Resource supprimée avec succès !');
        }

        return $this->redirectToRoute('app_resource_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
