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
  
#[Route('/secteurlist2', name: 'secteur_list2', methods:['GET'])]
public function SecteurList2(): Response
{
    // Récupérer la liste des auteurs
    $secteurs = $this->SecteurRepo->findAll(); 

    // Rendre la vue avec la liste des auteurs
    return $this->render('secteur/secteurslist.html.twig', [
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
#[Route('/secteur/delete/{id}', name: 'secteur_delete', methods: ['GET', 'DELETE'])]
public function delete(Secteur $secteur): Response
{
    // Optionnel : vérifier si des sponsors sont associés
    if (!$secteur->getSponsors()->isEmpty()) {
        $this->addFlash('error', 'Impossible de supprimer ce secteur car des sponsors y sont associés.');
        return $this->redirectToRoute('secteur_list'); // à adapter selon ta route
    }

    $this->entityManager->remove($secteur);
    $this->entityManager->flush();

    $this->addFlash('success', 'Secteur supprimé avec succès.');
    return $this->redirectToRoute('secteur_list'); // à adapter selon ta route
}

#[Route('/secteur/edit/{id}', name: 'secteur_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Secteur $secteur): Response
{
    $form = $this->createForm(SecteurType::class, $secteur);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->entityManager->flush();

        $this->addFlash('success', 'Secteur mis à jour avec succès.');
        return $this->redirectToRoute('secteur_list'); // à adapter selon ta route
    }

    return $this->render('secteur/edit.html.twig', [
        'form' => $form->createView(),
        'secteur' => $secteur,
    ]);
}
}
