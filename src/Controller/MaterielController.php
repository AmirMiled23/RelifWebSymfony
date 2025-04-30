<?php

namespace App\Controller;

use App\Entity\Materiel;
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

    #[Route('/{id_materiel}', name: 'app_materiel_show', methods: ['GET'])]
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
        // Récupérer tous les matériels
        $materiels = $materielRepository->findAll();

        // Configurer DomPDF
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Générer le HTML à partir du template Twig
        $html = $this->renderView('materiel/pdf.html.twig', [
            'materiels' => $materiels, // Liste des matériels
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Retourner le PDF en réponse
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="liste_materiels.pdf"',
        ]);
    }


}
