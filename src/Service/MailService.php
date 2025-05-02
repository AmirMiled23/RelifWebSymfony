<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Psr\Log\LoggerInterface;

class MailService
{
    private MailerInterface $mailer;
    private LoggerInterface $logger;

    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public function sendEmail(string $to, string $subject, string $content): bool
    {
        try {
            $email = (new Email())
                ->from('khalil.bergaoui@esprit.tn') // Remplacez par votre adresse e-mail
                ->to($to)
                ->subject($subject)
                ->html($content);

            $this->mailer->send($email);

            $this->logger->info("E-mail envoyé à {$to} avec le sujet : {$subject}");
            return true;
        } catch (\Exception $e) {
            $this->logger->error("Erreur lors de l'envoi de l'e-mail : " . $e->getMessage());
            return false;
        }
    }

    public function sendReservationEmail(string $to, string $subject, array $context): bool
    {
        try {
            $email = (new TemplatedEmail())
                ->from('khalil.bergaoui@esprit.tn')
                ->to($to)
                ->subject($subject)
                ->htmlTemplate('emails/reservation.html.twig')
                ->context($context);

            $this->mailer->send($email);

            $this->logger->info("E-mail envoyé à {$to} avec le sujet : {$subject}");
            return true;
        } catch (\Exception $e) {
            $this->logger->error("Erreur lors de l'envoi de l'e-mail : " . $e->getMessage());
            return false;
        }
    }
}
