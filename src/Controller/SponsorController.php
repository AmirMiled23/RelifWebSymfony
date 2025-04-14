<?php

namespace App\Controller;

use App\Entity\Sponsor;
use App\Form\SponsorType;
use App\Repository\SecteurRepository;
use App\Repository\SponsorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class SponsorController extends AbstractController{
    private $SponsorRepo;
    private $entityManager;
    
    public function __construct(SponsorRepository $sponsorRepository,EntityManagerInterface $entityManagerParam)
    {
       
        $this->SponsorRepo=$sponsorRepository; 
        $this->entityManager=$entityManagerParam;
       

     
}
     #[Route('/SponsorList', name: 'sponsor_list', methods:['GET'])]
        public function SponsorList(): Response
        {
     
        $sponsors = $this->SponsorRepo->findAll(); 

   
    return $this->render('sponsor/list.html.twig', [
        'sponsors' => $sponsors,
    ]);}


    #[Route('/sponsor', name: 'app_sponsor')]
    public function index(): Response
    {
        return $this->render('sponsor/index.html.twig', [
            'controller_name' => 'SponsorController',
        ]);
    }
    #[Route('/AddSponsor', name: 'add_sponsor', methods: ['GET', 'POST'])]
    public function addSponsor(Request $request, SluggerInterface $slugger): Response
    {
        $sponsor = new Sponsor();
        $form = $this->createForm(SponsorType::class, $sponsor);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form->get('photo')->getData();
    
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();
    
                try {
                    $photoFile->move(
                        $this->getParameter('photo_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                 
                }
    
                $sponsor->setPhoto($newFilename);
            }
    
            $this->entityManager->persist($sponsor);
            $this->entityManager->flush();
    
            return $this->redirectToRoute('sponsor_list');
        }
    
        return $this->render('sponsor/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/deleteSponsor/{id}', name: 'deleteSponsor', methods: ['GET','DELETE'])]
    public function deleteLivre(Sponsor $sponsor):Response{
        if($sponsor){
      ;
        $this->entityManager->remove($sponsor);
        $this->entityManager->flush();
        }
        return $this->redirectToRoute('sponsor_list');

    }
    #[Route('/sponsor/edit/{id}', name: 'edit_sponsor', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sponsor $sponsor, SluggerInterface $slugger): Response
    {
        // Sauvegarde de l'ancienne photo
        $anciennePhoto = $sponsor->getPhoto();
        
        $form = $this->createForm(SponsorType::class, $sponsor);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form->get('photo')->getData();
            
            if ($photoFile) {
                // Suppression de l'ancienne photo
                if ($anciennePhoto) {
                    $ancienChemin = $this->getParameter('photos_directory').'/'.$anciennePhoto;
                    if (file_exists($ancienChemin)) {
                        unlink($ancienChemin);
                    }
                }
    
                // Génération du nouveau nom de fichier
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = 'sponsor-'.$safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();
    
                try {
                    $photoFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                    $sponsor->setPhoto($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors du téléchargement de la photo');
                }
            } else {
                // Si aucun nouveau fichier, on conserve l'ancien
                $sponsor->setPhoto($anciennePhoto);
            }
    
            $this->entityManager->flush();
            $this->addFlash('success', 'Sponsor mis à jour avec succès');
            return $this->redirectToRoute('sponsor_list');
        }
    
        return $this->render('sponsor/edit.html.twig', [
            'form' => $form->createView(),
            'sponsor' => $sponsor
        ]);
    }
    
}


