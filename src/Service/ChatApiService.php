<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ChatApiService
{
    private $client;
    private $geminiApiKey;

    public function __construct(HttpClientInterface $client, string $geminiApiKey)
    {
        $this->client = $client;
        $this->geminiApiKey = $geminiApiKey;
    }

    public function getResponse(string $prompt): string
    {
        $response = $this->client->request('POST', 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro-001:generateContent', [
            'query' => [
                'key' => $this->geminiApiKey,
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'contents' => [
                    ['parts' => [['text' => $prompt]]],
                ],
            ],
        ]);
    
        // Convertir la réponse en tableau
        $data = $response->toArray(false);
    
        // Extraire le texte de la réponse générée
        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return $data['candidates'][0]['content']['parts'][0]['text'];
        }
    
        // Retourner un message d'erreur si aucune réponse n'est générée
        return 'Sorry, I could not generate a response.';
    }
    
    
}