<?php

namespace App\Controller;

use App\Entity\Resource;
use App\Form\ResourceType;
use App\Repository\ResourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/resource')]
final class ResourceController extends AbstractController
{
    private Pdf $pdfGenerator;

    public function __construct(Pdf $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    #[Route(name: 'app_resource_index', methods: ['GET'])]
    public function index(ResourceRepository $resourceRepository): Response
    {
        return $this->render('resource/index.html.twig', [
            'resources' => $resourceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_resource_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $resource = new Resource();
        $form = $this->createForm(ResourceType::class, $resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('pdf')->getData();

            if ($file) {
                $fileName = uniqid() . '.' . $file->guessExtension();
                $file->move($this->getParameter('pdf_directory'), $fileName);
                $resource->setPdfPath($fileName);
            }

            $entityManager->persist($resource);
            $entityManager->flush();

            return $this->redirectToRoute('app_resource_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('resource/new.html.twig', [
            'resource' => $resource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resource_show', methods: ['GET'])]
    public function show(Resource $resource): Response
    {
        return $this->render('resource/show.html.twig', [
            'resource' => $resource,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_resource_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Resource $resource, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ResourceType::class, $resource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_resource_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('resource/edit.html.twig', [
            'resource' => $resource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resource_delete', methods: ['POST'])]
    public function delete(Request $request, Resource $resource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resource->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($resource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_resource_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/upload', name: 'resource_upload', methods: ['POST'])]
    public function uploadPdf(Request $request, EntityManagerInterface $entityManager): Response
    {
        $file = $request->files->get('pdf');

        if ($file instanceof UploadedFile && $file->isValid()) {
            $fileName = uniqid() . '.' . $file->guessExtension();
            $file->move($this->getParameter('pdf_directory'), $fileName);

            $resource = new Resource();
            $resource->setPdfPath($fileName);
            $entityManager->persist($resource);
            $entityManager->flush();

            return new Response('PDF uploaded successfully!');
        }

        return new Response('Invalid file upload.', Response::HTTP_BAD_REQUEST);
    }

    #[Route('/export/{id}', name: 'resource_export', methods: ['GET'])]
    public function exportPdf(Resource $resource): BinaryFileResponse
    {
        $pdfFilePath = $this->getParameter('pdf_directory') . '/' . $resource->getPdfPath();

        if (!file_exists($pdfFilePath)) {
            throw $this->createNotFoundException('The requested PDF file does not exist.');
        }

        return new BinaryFileResponse($pdfFilePath);
    }
}
