<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Psr\Log\LoggerInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class AppCustomAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private LoggerInterface $logger,
        private UserRepository $userRepository
    ) {
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email_user', '');
        $password = $request->request->get('password', '');
    
        // Vérifier si l'utilisateur existe
        $user = $this->userRepository->findOneBy(['email_user' => $email]);
        
        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Identifiants invalides.');
        }
    
        // Vérifier si l'utilisateur est banni (méthode améliorée)
        if ($user->isBanned()) {
            $this->logger->warning('Tentative de connexion d\'un utilisateur banni', ['email' => $email]);
            throw new CustomUserMessageAuthenticationException('Votre compte est suspendu. Contactez l\'administrateur.');
        }
    
        $request->getSession()->set(Security::LAST_USERNAME, $email);
    
        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($password),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Récupérer l'utilisateur connecté
        $user = $token->getUser();

        // Vérifier si l'utilisateur a le rôle ROLE_ADMIN
        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return new RedirectResponse($this->urlGenerator->generate('app_back_user_index')); // Redirige vers le back-office
        }

        // Rediriger les autres utilisateurs vers une page par défaut (par exemple, tableau de bord utilisateur)
        return new RedirectResponse($this->urlGenerator->generate('app_user_index'));
    }

    protected function getLoginUrl(Request $request):String
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
    

}