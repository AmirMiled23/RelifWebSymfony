<?php

namespace App\Controller;

use App\Entity\CategorieEvent;
use App\Repository\CategorieEventRepository;
use App\Form\CategorieEventType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategorieEventController extends AbstractController
{
 #[Route('/ajouter-evenement', name: 'ajout_event')]
 public function ajouterCategorie(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
 
 {
    $categorie = new CategorieEvent();
    $form = $this->createForm(CategorieEventType::class, $categorie);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        /** @var UploadedFile $imageFile */
        $imageFile = $form->get('image')->getData();

        if ($imageFile) {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

            $imageFile->move(
                $this->getParameter('categorie_images_directory'),
                $newFilename
            );

            $categorie->setImage($newFilename);
        }

        $em->persist($categorie);
        $em->flush();

        $this->addFlash('success', 'Catégorie ajoutée avec succès !');
        return $this->redirectToRoute('ajout_event');
    }

    return $this->render('AjoutCat.html.twig', [
        'form' => $form->createView()
    ]);
}
#[Route('/liste-categories', name: 'liste_categories')]
public function listeCategories(CategorieEventRepository $repo): Response
{
    $categories = $repo->findAll();

    return $this->render('listCat.html.twig', [
        'categories' => $categories
    ]);
}
#[Route('/supprimer-categorie/{id}', name: 'supprimer_categorie')]
public function supprimerCategorie(CategorieEvent $categorie, EntityManagerInterface $em): Response
{
    $em->remove($categorie);
    $em->flush();

    $this->addFlash('success', 'Catégorie supprimée avec succès.');
    return $this->redirectToRoute('liste_categories');
}

#[Route('/modifier-categorie/{id}', name: 'modifier_categorie')]
public function modifierCategorie(
    CategorieEvent $categorie,
    Request $request,
    EntityManagerInterface $em,
    SluggerInterface $slugger
): Response {
    $form = $this->createForm(CategorieEventType::class, $categorie);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $request->isMethod('POST') && $form->isValid()) {
        $imageFile = $form->get('image')->getData();

        if ($imageFile) {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

            $imageFile->move(
                $this->getParameter('categorie_images_directory'),
                $newFilename
            );

            $categorie->setImage($newFilename);
        }

        $em->flush();

        $this->addFlash('success', 'Catégorie modifiée avec succès !');
        return $this->redirectToRoute('liste_categories');
    }

    return $this->render('ModifierCat.html.twig', [
        'form' => $form->createView(),
        
    ]);
}





}