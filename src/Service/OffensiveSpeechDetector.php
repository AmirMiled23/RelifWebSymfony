<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OffensiveSpeechDetector
{
    private $client;
    private $apiToken;

    public function __construct(HttpClientInterface $client, string $apiToken)
    {
        $this->client = $client;
        $this->apiToken = $apiToken;
    }

    public function isOffensive(string $text): bool
    {
        $response = $this->client->request('POST', 'https://api-inference.huggingface.co/models/unitary/toxic-bert', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ],
            'json' => ['inputs' => $text],
        ]);
        
        

        $data = $response->toArray();

        if (!isset($data[0])) return false;

        foreach ($data[0] as $labelData) {
            // Ce modèle retourne des labels comme "toxicity", "insult", "obscene", etc.
            if (
                in_array(strtolower($labelData['label']), ['toxicity', 'insult', 'obscene', 'identi aty_attack', 'threat']) 
                && $labelData['score'] > 0.5
            ) {
                return true;
            }
        }
        

        return false;
    }
}
