<?php

namespace App\Service;

use Postmark\PostmarkClient;
use Psr\Log\LoggerInterface;

class PostmarkService
{
    private PostmarkClient $postmarkClient;
    private string $fromEmail;
    private LoggerInterface $logger;

    public function __construct(PostmarkClient $postmarkClient, string $fromEmail, LoggerInterface $logger)
    {
        $this->postmarkClient = new PostmarkClient($_ENV['POSTMARK_API_KEY']);
        $this->fromEmail = $_ENV['POSTMARK_FROM_EMAIL'];
        $this->logger = $logger;
    }

    public function sendEmail(string $toEmail, string $subject, string $message): bool
    {
        try {
            $this->postmarkClient->sendEmail(
                $this->fromEmail,
                $toEmail,
                $subject,
                $message
            );

            return true;
        } catch (\Exception $e) {
            $this->logger->error('Erreur Postmark : ' . $e->getMessage());
            return false;
        }
    }
}
