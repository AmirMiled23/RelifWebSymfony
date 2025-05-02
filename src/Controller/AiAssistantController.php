<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class AiAssistantController extends AbstractController
{
    private $httpClient;
    private $logger;
    
    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    #[Route('/api/ai-assistant/chat', name: 'app_ai_assistant_chat', methods: ['POST'])]
    public function chat(Request $request): JsonResponse
    {
        // Get request data
        $data = json_decode($request->getContent(), true);
        
        // Validate input
        if (!isset($data['message']) || empty($data['message'])) {
            return new JsonResponse(['error' => 'No message provided', 'success' => false], 400);
        }
        
        $message = $data['message'];
        $history = $data['history'] ?? [];
        
        $this->logger->info('Chat request received', ['message' => $message]);
        
        try {
            $apiKey = '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';
            
            // Prepare messages in the required format
            $messages = [];
            
            // Add powerful system message that defines the AI's behavior and knowledge
            $messages[] = [
                'role' => 'system',
                'content' => 'You are an expert AI assistant specializing in conferences, events, and event management. 
                Your knowledge includes conference planning, scheduling, budgeting, speaker coordination, venue selection,
                marketing strategies, ticketing systems, virtual and hybrid event technologies, and industry trends.
                Provide specific, detailed, and helpful information in response to questions. If asked about AI,
                focus on AI conferences, AI speakers, or AI technologies used in event management.
                Always provide concrete examples and actionable advice. Be conversational but concise.'
            ];
            
            // Format history properly
            foreach ($history as $entry) {
                // Ensure we're only using valid roles
                if (in_array($entry['role'], ['user', 'assistant', 'system'])) {
                    $messages[] = [
                        'role' => $entry['role'],
                        'content' => $entry['content']
                    ];
                }
            }
            
            // Add current user message
            $messages[] = [
                'role' => 'user',
                'content' => $message
            ];
            
            try {
                $this->logger->info('Sending request to OpenRouter API');
                
                // Make request to OpenRouter API
                $response = $this->httpClient->request('POST', 'https://openrouter.ai/api/v1/chat/completions', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $apiKey,
                        'Content-Type' => 'application/json',
                        'HTTP-Referer' => $request->getSchemeAndHttpHost(), 
                        'X-Title' => 'Conference Assistant'
                    ],
                    'json' => [
                        'model' => 'anthropic/claude-3-haiku', // Using Claude 3 Haiku for good balance
                        'messages' => $messages,
                        'temperature' => 0.7,
                        'max_tokens' => 500, // Allow longer responses for more detailed info
                    ],
                ]);
                
                $result = $response->toArray();
                $this->logger->info('OpenRouter response received', ['response' => $result]);
                
                return new JsonResponse([
                    'reply' => $result['choices'][0]['message']['content'] ?? 'Sorry, I couldn\'t generate a response.',
                    'success' => true,
                ]);
            } catch (\Exception $innerException) {
                $this->logger->error('OpenRouter API error', ['exception' => $innerException->getMessage()]);
                
                // Enhanced fallback responses based on intent detection
                $userMessage = strtolower($message);
                $reply = $this->generateFallbackResponse($userMessage);
                
                return new JsonResponse([
                    'reply' => $reply,
                    'success' => true,
                ]);
            }
            
        } catch (\Exception $e) {
            $this->logger->error('General error in chat controller', ['exception' => $e->getMessage()]);
            return new JsonResponse([
                'error' => 'Error processing your request: ' . $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }
    
    private function generateFallbackResponse(string $userMessage): string
    {
        // Advanced intent detection for better responses even in fallback mode
        if (preg_match('/(ai|artificial intelligence|machine learning|ml|deep learning)/i', $userMessage)) {
            return "AI is transforming the conference industry! Popular AI-related events include NeurIPS, ICML, AI Summit, and the Conference on Computer Vision and Pattern Recognition (CVPR). These events feature discussions on machine learning, generative AI, AI ethics, and industry applications. Many conferences now also use AI for attendee matchmaking, personalized scheduling, and automated content summarization. Would you like more specific information about AI in events or AI-focused conferences?";
        } 
        else if (preg_match('/(manage|managing|management|organize|organizing|planning|plan)/i', $userMessage)) {
            return "Effective event management follows these key principles: 1) Set clear goals and KPIs, 2) Create detailed budgets and timelines, 3) Select appropriate venues and vendors, 4) Develop compelling content and speakers, 5) Implement robust registration systems, 6) Execute detailed on-site logistics, and 7) Conduct thorough post-event analysis. Professional event management software like Cvent, Eventbrite, or Bizzabo can streamline these processes. Which aspect of event management would you like me to elaborate on?";
        }
        else if (preg_match('/(price|pricing|cost|budget|expensive|cheap|affordable)/i', $userMessage)) {
            return "Conference pricing varies widely based on type, length, and location. Industry conferences typically range from $300-$2,000 per attendee. Academic conferences often cost $200-$800. For organizing events, budgets should account for venue (30-40% of costs), catering (20-25%), speakers (10-15%), marketing (10%), technology (5-10%), and contingencies (10%). Many conferences offer early bird rates (15-30% discount), student prices, and virtual attendance options at reduced rates. What specific pricing information are you looking for?";
        }
        else if (preg_match('/(virtual|online|remote|hybrid|digital)/i', $userMessage)) {
            return "Virtual and hybrid events have become standard in the conference industry. Key technologies include platforms like Hopin, Accelevents, and Airmeet that offer livestreaming, networking rooms, virtual expo halls, and interactive Q&A. Best practices include shorter sessions (20-30 minutes), frequent breaks, interactive elements like polls and breakout rooms, high-quality pre-recorded content, and dedicated engagement hosts. Hybrid events require special attention to create equivalent experiences for both in-person and remote attendees. Would you like tips for a specific aspect of virtual conferencing?";
        }
        else if (preg_match('/(trend|trends|future|innovation|new|emerging)/i', $userMessage)) {
            return "Current conference industry trends include: 1) AI-powered matchmaking and personalization, 2) Sustainable and carbon-neutral event practices, 3) Micro-conferences and boutique experiences, 4) Enhanced networking through purpose-built apps and platforms, 5) Immersive technologies like AR/VR for engagement, 6) Year-round community building beyond single events, and 7) Data-driven event design using attendee analytics. The industry is also seeing increased focus on wellness activities, diversity and inclusion initiatives, and unconference formats. Which trend interests you most?";
        }
        
        // General fallback response
        return "I'd be happy to help with your question about conferences and events. To provide the most relevant information, could you please specify what aspect you're interested in? I can discuss planning, budgeting, venue selection, speaker management, marketing strategies, or technology solutions for conferences.";
    }
}
