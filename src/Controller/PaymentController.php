<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Entity\Inscription;
use App\Entity\Conference;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment/new", name="app_payment_new", methods={"POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Get payment details from the request
        $inscriptionId = $request->request->get('inscription_id');
        $conferenceId = $request->request->get('conference_id');
        $paymentType = $request->request->get('payment_type');
        $amount = $request->request->get('amount');
        
        // Find the associated entities
        $inscription = $entityManager->getRepository(Inscription::class)->find($inscriptionId);
        $conference = $entityManager->getRepository(Conference::class)->find($conferenceId);
        
        // Create new Payment entity
        $payment = new Payment();
        $payment->setInscriptionId($inscriptionId);
        $payment->setConferenceId($conferenceId);
        $payment->setPaymentType($paymentType);
        $payment->setAmount($amount);
        $payment->setPaymentDate(new \DateTime());
        
        // Handle Stripe token if available
        if ($paymentType === 'Carte Bancaire' && $request->request->has('stripeToken')) {
            $stripeToken = $request->request->get('stripeToken');
            
            // Process payment with Stripe
            $success = $this->processStripePayment($stripeToken, $amount, $inscriptionId);
            
            if ($success) {
                $payment->setStatus('completed');
            } else {
                $payment->setStatus('failed');
                
                // Redirect to error page if payment failed
                $this->addFlash('error', 'Le paiement a échoué. Veuillez réessayer.');
                return $this->redirectToRoute('app_conference_show', ['id' => $conferenceId]);
            }
        } else if ($paymentType === 'GoogleApplePay') {
            // Handle digital wallet payments
            $walletType = $request->request->get('wallet_type');
            $payment->setStatus('completed');
            // Store additional data
            $payment->setAdditionalData(json_encode(['wallet_type' => $walletType]));
        } else {
            // For SEPA or other payment methods
            if ($paymentType === 'Virement SEPA' || $paymentType === 'Prélèvement SEPA') {
                $accountHolder = $request->request->get('account_holder');
                $iban = $request->request->get('iban');
                $payment->setAdditionalData(json_encode([
                    'account_holder' => $accountHolder,
                    'iban' => $iban
                ]));
            }
            
            $payment->setStatus('pending');
        }
        
        // Save payment
        $entityManager->persist($payment);
        $entityManager->flush();
        
        // Add a success flash message
        $this->addFlash('success', 'Votre paiement a été traité avec succès.');
        
        // Redirect to success page
        return $this->redirectToRoute('app_payment_success');
    }
    
    /**
     * @Route("/payment/success", name="app_payment_success", methods={"GET"})
     */
    public function success(): Response
    {
        return $this->render('payment/success.html.twig');
    }
    
    /**
     * @Route("/payment/create-intent", name="app_payment_create_intent", methods={"POST"})
     */
    public function createIntent(Request $request): JsonResponse
    {
        // Get data from the request
        $data = json_decode($request->getContent(), true);
        $amount = $data['amount'] ?? 0;
        $currency = $data['currency'] ?? 'eur';
        
        try {
            // Configure Stripe API key
            \Stripe\Stripe::setApiKey('sk_test_51Qyl1xFMW7DU2mdynAnyaMyqen3Hggn8bowIcuNDynlOe4leo7rdkDTdVADt0BIwoT5KZLMnJlCGHekivruEHoz600KEOWwBxQ');
            
            // Create a payment intent
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => $currency,
                'description' => 'Conference registration payment',
                'metadata' => [
                    'inscription_id' => $data['id'] ?? '',
                    'conference_id' => $data['conference_id'] ?? ''
                ]
            ]);
            
            return new JsonResponse(['clientSecret' => $intent->client_secret]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
    
    /**
     * @Route("/payment/update", name="app_payment_update", methods={"POST"})
     */
    public function updatePayment(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Get data from the request
        $data = json_decode($request->getContent(), true);
        
        try {
            // Create new Payment entity
            $payment = new Payment();
            $payment->setInscriptionId($data['inscription_id']);
            $payment->setConferenceId($data['conference_id'] ?? '0');
            $payment->setPaymentType($data['payment_type']);
            $payment->setAmount($data['amount']);
            $payment->setStatus($data['status']);
            $payment->setPaymentDate(new \DateTime());
            $payment->setAdditionalData(json_encode(['payment_id' => $data['payment_id']]));
            
            // Save payment
            $entityManager->persist($payment);
            $entityManager->flush();
            
            return new JsonResponse(['success' => true]);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    
    /**
     * @Route("/payment/process-sepa", name="app_payment_process_sepa", methods={"POST"})
     */
    public function processSepa(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Get data from the request
        $data = json_decode($request->getContent(), true);
        
        try {
            // Create a new payment record
            $payment = new Payment();
            $payment->setInscriptionId($data['inscription_id']);
            $payment->setConferenceId($data['conference_id']);
            $payment->setPaymentType($data['payment_type']);
            $payment->setAmount($data['amount']);
            $payment->setStatus('pending');
            $payment->setPaymentDate(new \DateTime());
            $payment->setAdditionalData(json_encode([
                'account_holder' => $data['account_holder'],
                'iban' => $data['iban']
            ]));
            
            // Save payment
            $entityManager->persist($payment);
            $entityManager->flush();
            
            return new JsonResponse(['success' => true]);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    
    /**
     * @Route("/payment/process-digital", name="app_payment_process_digital", methods={"POST"})
     */
    public function processDigitalWallet(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Get data from the request
        $data = json_decode($request->getContent(), true);
        
        try {
            // Create a new payment record
            $payment = new Payment();
            $payment->setInscriptionId($data['inscription_id']);
            $payment->setConferenceId($data['conference_id']);
            $payment->setPaymentType($data['payment_type']);
            $payment->setAmount($data['amount']);
            $payment->setStatus('completed');
            $payment->setPaymentDate(new \DateTime());
            $payment->setAdditionalData(json_encode([
                'wallet_type' => $data['wallet_type']
            ]));
            
            // Save payment
            $entityManager->persist($payment);
            $entityManager->flush();
            
            return new JsonResponse(['success' => true]);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    
    /**
     * Process a payment with Stripe
     */
    private function processStripePayment(string $token, float $amount, string $inscriptionId): bool
    {
        try {
            // Configure Stripe API key
            \Stripe\Stripe::setApiKey('sk_test_51Qyl1xFMW7DU2mdynAnyaMyqen3Hggn8bowIcuNDynlOe4leo7rdkDTdVADt0BIwoT5KZLMnJlCGHekivruEHoz600KEOWwBxQ');
            
            // Create a charge
            $charge = \Stripe\Charge::create([
                'amount' => $amount * 100, // Amount in cents
                'currency' => 'eur',
                'description' => 'Conference registration',
                'source' => $token,
                'metadata' => [
                    'inscription_id' => $inscriptionId
                ]
            ]);
            
            return $charge->status === 'succeeded';
        } catch (\Exception $e) {
            // Log the error
            // You might want to implement proper logging here
            return false;
        }
    }
}
