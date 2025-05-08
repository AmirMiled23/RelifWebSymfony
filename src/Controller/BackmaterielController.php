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
use Dompdf\Dompdf;
use Dompdf\Options;

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

    #[Route('/{id_materiel}', name: 'app_backmateriel_show', methods: ['GET'], requirements: ['id_materiel' => '\d+'])]
public function show(int $id_materiel, MaterielRepository $materielRepository): Response
{
    $materiel = $materielRepository->find($id_materiel);

    if (!$materiel) {
        throw $this->createNotFoundException('Matériel non trouvé.');
    }

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

    #[Route('/{id}', name: 'app_backmateriel_delete', methods: ['POST'])]
    public function delete(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materiel->getId(), $request->get('_token'))) {
            $entityManager->remove($materiel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_backmateriel_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/pdf', name: 'app_backmateriel_pdf', methods: ['GET'])]
    public function generatePdf(MaterielRepository $materielRepository): Response
    {
        // Configure Dompdf
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($pdfOptions);

        // Fetch all materiels
        $materiels = $materielRepository->findAll();

        // Render the view
        $html = $this->renderView('backmateriel/pdf.html.twig', [
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
            'Content-Disposition' => 'inline; filename="materiels.pdf"',
        ]);
    }

    #[Route('/search', name: 'app_backmateriel_search', methods: ['GET'])]
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

        return $this->render('backmateriel/index.html.twig', [
            'materiels' => $materiels,
        ]);
    }
}