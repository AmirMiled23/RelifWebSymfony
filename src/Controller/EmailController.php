<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class EmailController extends AbstractController{


#[Route('/sendmail/{email}', name: 'send_mail')]
public function sendMail(string $email, MailerInterface $mailer): Response
{
    try {
        $emailMessage = (new Email())
            ->from('testprojetpi@gmail.com')
            ->to($email)
            ->subject('Message dynamique')
            ->text('Ceci est un e-mail envoyé dynamiquement via Symfony.')
            ->html('<p>Bonjour, ceci est un e-mail HTML dynamique envoyé par Symfony.</p>');

        // Essai d'envoi
        $mailer->send($emailMessage);

        return new Response("✅ E-mail envoyé à : $email");
    } catch (TransportExceptionInterface $e) {
        // Erreur liée au transport d'e-mail (SMTP, réseau, etc.)
        return new Response('❌ Erreur de transport : ' . $e->getMessage());
    } catch (\Exception $e) {
        // Autres types d'erreurs (structure de l'email, etc.)
        return new Response('❌ Erreur générale : ' . $e->getMessage());
    }
}

}
