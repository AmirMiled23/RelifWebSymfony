<?php
namespace App\Controller;



use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use App\Form\ForgotPasswordType;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Symfony s'en occupe tout seul
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/Forgot', name: 'forgot_password')]
    public function ForgotPassword(
        Request $request,
        UserRepository $userRepository,
        TokenGeneratorInterface $tokenGenerator,
        TransportInterface $mailer,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $donnees = $form->get('Email')->getData(); // Récupérer l'email depuis le formulaire

            $user = $userRepository->findOneBy(['email_user' => $donnees]);
            if (!$user) {
                $this->addFlash('danger', 'Cette adresse email n\'existe pas.');
                return $this->redirectToRoute("forgot_password");
            }

            $token = $tokenGenerator->generateToken();

            try {
                $user->setToken($token);
                $entityManager->persist($user);
                $entityManager->flush();
            } catch (\Exception $exception) {
                $this->addFlash('warning', 'Une erreur est survenue : ' . $exception->getMessage());
                return $this->redirectToRoute("app_login");
            }

            $url = $this->generateUrl('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

            // Envoi de l'email
            $email = (new TemplatedEmail())
                ->from('samer.zouaoui@esprit.tn') // Votre email
                ->to($user->getEmailUser())
                ->subject('Réinitialisation de votre mot de passe')
                ->html("<p>Bonjour,</p><p>Une demande de réinitialisation de mot de passe a été effectuée. Veuillez cliquer sur le lien suivant : <a href='$url'>$url</a></p>");

            $mailer->send($email);

            $this->addFlash('message', 'Un email de réinitialisation de mot de passe a été envoyé.');
            return $this->redirectToRoute("app_login");
        }

        return $this->render("security/forgot_password.html.twig", ['form' => $form->createView()]);
    }

    #[Route('/resetpassword/{token}', name: 'app_reset_password')]
    public function resetpassword(
        Request $request,
        string $token,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $user = $userRepository->findOneBy(['token' => $token]);

        if (!$user) {
            $this->addFlash('danger', 'Token inconnu.');
            return $this->redirectToRoute("app_login");
        }

        if ($request->isMethod('POST')) {
            $user->setToken(null);
            $newPassword = $request->request->get('password');
            $user->setPassword($passwordHasher->hashPassword($user, $newPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Votre mot de passe a été mis à jour.');
            return $this->redirectToRoute("app_login");
        }

        return $this->render("security/reset_password.html.twig", ['token' => $token]);
    }
}

