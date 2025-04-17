<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\Materiel1Type;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/backmateriel')]
final class BackmaterielController extends AbstractController
{
    #[Route(name: 'app_backmateriel_index', methods: ['GET'])]
    public function index(MaterielRepository $materielRepository): Response
    {
        return $this->render('backmateriel/index.html.twig', [
            'materiels' => $materielRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_backmateriel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $materiel = new Materiel();
        $form = $this->createForm(Materiel1Type::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($materiel);
            $entityManager->flush();

            return $this->redirectToRoute('app_backmateriel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backmateriel/new.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }

    #[Route('/{id_materiel}', name: 'app_backmateriel_show', methods: ['GET'])]
    public function show(Materiel $materiel): Response
    {
        return $this->render('backmateriel/show.html.twig', [
            'materiel' => $materiel,
        ]);
    }

    #[Route('/{id_materiel}/edit', name: 'app_backmateriel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Materiel1Type::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_backmateriel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('backmateriel/edit.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }

    #[Route('/{id_materiel}', name: 'app_backmateriel_delete', methods: ['POST'])]
    public function delete(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materiel->getId_materiel(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($materiel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_backmateriel_index', [], Response::HTTP_SEE_OTHER);
    }
}