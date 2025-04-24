<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/back/user')]
final class BackUserController extends AbstractController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route(name: 'app_back_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('back_user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_back_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $user->getPwUser()
            );
            $user->setPwUser($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Utilisateur créé avec succès.');

            return $this->redirectToRoute('app_back_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back_user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_back_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('back_user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_back_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(User1Type::class, $user, ['is_edit' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush(); 
            $this->addFlash('success', 'Utilisateur mis à jour avec succès.');
        
            return $this->redirectToRoute('app_back_user_index');
        }

        return $this->render('back_user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}', name: 'app_back_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getIdUser(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_back_user_index');
    }
}