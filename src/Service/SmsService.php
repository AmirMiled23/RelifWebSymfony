<?php

namespace App\Service;

use MessageBird\Client;
use MessageBird\Exceptions\AuthenticateException;
use MessageBird\Exceptions\BalanceException;
use MessageBird\Objects\Message;

class SmsService
{
    private Client $client;
    private string $senderId;

    public function __construct(string $messageBirdApiKey, string $senderId)
    {
        $this->client = new Client($messageBirdApiKey);
        $this->senderId = $senderId; // soit un nom, soit un numéro approuvé
    }

    public function sendSms(string $to, string $messageText): void
    {
        $message = new Message();
        $message->originator = $this->senderId;
        $message->recipients = [$to]; // format : 216XXXXXXXX
        $message->body = $messageText;

        try {
            $this->client->messages->create($message);
        } catch (AuthenticateException $e) {
            throw new \RuntimeException('Authentication with MessageBird failed: ' . $e->getMessage());
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to send SMS: ' . $e->getMessage());
        }
    }
}
