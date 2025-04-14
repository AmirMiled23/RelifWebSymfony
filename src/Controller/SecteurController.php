<?php

namespace App\Controller;

use App\Entity\Secteur;
use App\Form\SecteurType;
use App\Repository\SecteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SecteurController extends AbstractController{
    private $SecteurRepo;
    private $entityManager;
    
    public function __construct(SecteurRepository $secteurRepository,EntityManagerInterface $entityManagerParam)
    {
       
        $this->SecteurRepo=$secteurRepository; 
        $this->entityManager=$entityManagerParam;
       

     
}
#[Route('/secteurlist', name: 'secteur_list', methods:['GET'])]
public function SecteurList(): Response
{
    // Récupérer la liste des auteurs
    $secteurs = $this->SecteurRepo->findAll(); 

    // Rendre la vue avec la liste des auteurs
    return $this->render('secteur/SecteurList.html.twig', [
        'secteurs' => $secteurs,
    ]);
}
    #[Route('/secteur', name: 'app_secteur')]
    public function index(): Response
    {
        return $this->render('secteur/index.html.twig', [
            'controller_name' => 'SecteurController',
        ]);
    }
    #[Route('/AddSecteur', name: 'add_secteur', methods: ['GET', 'POST'])]
    public function AddSecteur(Request $request): Response
{
    $secteur = new Secteur();
    $form = $this->createForm(SecteurType::class, $secteur);

    // Handle the form submission
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->persist($secteur);
        $this->entityManager->flush();

        return $this->redirectToRoute('secteur_list');
    }
    return $this->render('secteur/AddSecteu.html.twig', [
        'form' => $form->createView(),
    ]);
}
}
