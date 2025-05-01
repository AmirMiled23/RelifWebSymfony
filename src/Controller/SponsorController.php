<?php

namespace App\Controller;

use App\Entity\Sponsor;
use App\Form\SponsorType;
use App\Repository\SecteurRepository;
use App\Repository\SponsorRepository;
use App\Service\ChatApiService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport\Transports;
use Symfony\Component\Mime\Email;

use Symfony\Component\String\Slugger\SluggerInterface;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
final class SponsorController extends AbstractController{
    private $SponsorRepo;
    private $entityManager;
    private $chatApiService;
    public function __construct(SponsorRepository $sponsorRepository,EntityManagerInterface $entityManagerParam, ChatApiService $chatApiService)
    {
       
        $this->SponsorRepo=$sponsorRepository; 
        $this->entityManager=$entityManagerParam;
        $this->chatApiService = $chatApiService;

     
} #[Route('/chatbot', name: 'chatbot', methods: ['POST'])]
public function chatbot(Request $request): JsonResponse
{
    // Récupérer les données JSON envoyées
    $data = json_decode($request->getContent(), true);
    $prompt = $data['prompt'] ?? '';  // Le message à envoyer au chatbot

    if ($prompt) {
        // Recherche d'un sponsor par nom
        $sponsorRepository = $this->entityManager->getRepository(Sponsor::class);
        $sponsor = $sponsorRepository->findOneBy(['nom' => $prompt]);

        if ($sponsor) {
            // Si le sponsor est trouvé, créer un prompt enrichi
            $prompt = "Détails du sponsor : " . $sponsor->getNom() . " - " . $sponsor->getEmail() . " - " . $sponsor->getAdresse();
        }
        
        // Appeler votre service ChatApiService pour obtenir la réponse du chatbot
        $responseText = $this->chatApiService->getResponse($prompt);
    } else {
        $responseText = 'Please provide a prompt.';
    }

    // Retourner la réponse sous forme de JSON
    return $this->json([
        'prompt' => $prompt,
        'response' => $responseText,
    ]);
}

#[Route('/chat', name: 'chat')]
public function chat(): Response
{
    return $this->render('sponsor/chat.html.twig');
}


     #[Route('/SponsorList', name: 'sponsor_list', methods:['GET'])]
        public function SponsorList(): Response
        {
     
        $sponsors = $this->SponsorRepo->findAll(); 

   
    return $this->render('sponsor/list.html.twig', [
        'sponsors' => $sponsors,
    ]);}



    #[Route('/Sponsorlistuser', name: 'sponsor_list_user', methods:['GET'])]
    public function SponsorList1(): Response
    {
 
    $sponsors = $this->SponsorRepo->findAll(); 


return $this->render('sponsor/frontlist.html.twig', [
    'sponsors' => $sponsors,
]);}



    #[Route('/sponsor', name: 'app_sponsor')]
    public function index(): Response
    {
        return $this->render('sponsor/index.html.twig', [
            'controller_name' => 'SponsorController',
        ]);
    }
    #[Route('/AddSponsor', name: 'add_sponsor', methods: ['GET', 'POST'])]
    public function addSponsor(
        Request $request,
        SluggerInterface $slugger,
        MailerInterface $mailer,
        LoggerInterface $logger,
        EntityManagerInterface $em
    ): Response {
        $sponsor = new Sponsor();
        $form = $this->createForm(SponsorType::class, $sponsor);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement de la photo
            $photoFile = $form->get('photo')->getData();
    
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $photoFile->guessExtension();
    
                try {
                    $photoFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                    $sponsor->setPhoto($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Erreur lors de l\'upload du fichier.');
                    return $this->redirectToRoute('add_sponsor');
                }
            }
    
            // Enregistrement du sponsor
            $em->persist($sponsor);
            $em->flush();
    
            // Envoi d'e-mail de confirmation
            try {
                $emailContent = "
                    <h2>Bonjour {$sponsor->getNom()},</h2>
                    <p>Merci d'avoir rejoint notre plateforme en tant que sponsor !</p>
                    <p>Voici un récapitulatif de vos informations :</p>
                    <ul>
                        <li><strong>Nom :</strong> {$sponsor->getNom()}</li>
                        <li><strong>Email :</strong> {$sponsor->getEmail()}</li>
                    </ul>
                    <p>Nous sommes ravis de collaborer avec vous.</p>
                ";
    
                $email = (new Email())
                    ->from('testprojetpi@gmail.com')
                    ->to($sponsor->getEmail())  // You might want to use $sponsor->getEmail() here
                    ->subject('Bienvenue parmi nos sponsors !')
                    ->html($emailContent);
    
                // Envoi de l'email
                $mailer->send($email);
                $logger->info('Email de confirmation envoyé au sponsor : ' . $sponsor->getEmail());
    
                // Si l'email est envoyé avec succès
                $this->addFlash('success', 'Sponsor ajouté avec succès et e-mail envoyé à ' . $sponsor->getEmail());
            } catch (\Exception $e) {
                // Si l'envoi de l'email échoue
                $logger->error('Erreur email : ' . $e->getMessage());
                $this->addFlash('danger', 'Une erreur est survenue lors de l\'envoi de l\'email.');
                return $this->redirectToRoute('add_sponsor');
            }
    
            // Redirection vers la liste des sponsors après succès
            return $this->redirectToRoute('sponsor_list');
        }
    
        // Assurez-vous que l'adresse est définie ici
        $address = "Tunis, Tunis"; // Remplacez ceci par la logique pour obtenir l'adresse
    
        return $this->render('sponsor/add.html.twig', [
            'form' => $form->createView(),
            'address' => $address, // Passer la variable d'adresse à la vue
        ]);
    }
    
    

#[Route('/sponsor/statistics', name: 'sponsor_statistics')]
public function statistics(SponsorRepository $secteurRepository): Response
    {
        // Récupérer les statistiques des sponsors par secteur
        $statistics = $secteurRepository->countSponsorsBySecteur();

        // Préparer les données pour le graphique
        $secteurs = [];
        $counts = [];

        foreach ($statistics as $stat) {
            $secteurs[] = $stat['secteur_nom'];
            $counts[] = $stat['count'];
        }

        return $this->render('sponsor/statistics.html.twig', [
            'secteurs' => $secteurs,
            'counts' => $counts,
        ]);
    }
  
    
    
    #[Route('/deleteSponsor/{id}', name: 'deleteSponsor', methods: ['GET','DELETE'])]
    public function deleteLivre(Sponsor $sponsor):Response{
        if($sponsor){
      ;
        $this->entityManager->remove($sponsor);
        $this->entityManager->flush();
        }
        return $this->redirectToRoute('sponsor_list');

    }
    #[Route('/sponsor/edit/{id}', name: 'edit_sponsor', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sponsor $sponsor, SluggerInterface $slugger): Response
    {
        // Sauvegarde de l'ancienne photo
        $anciennePhoto = $sponsor->getPhoto();
        
        $form = $this->createForm(SponsorType::class, $sponsor);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form->get('photo')->getData();
            
            if ($photoFile) {
                // Suppression de l'ancienne photo
                if ($anciennePhoto) {
                    $ancienChemin = $this->getParameter('photos_directory').'/'.$anciennePhoto;
                    if (file_exists($ancienChemin)) {
                        unlink($ancienChemin);
                    }
                }
    
                // Génération du nouveau nom de fichier
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = 'sponsor-'.$safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();
    
                try {
                    $photoFile->move(
                        $this->getParameter('photos_directory'),
                        $newFilename
                    );
                    $sponsor->setPhoto($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors du téléchargement de la photo');
                }
            } else {
                // Si aucun nouveau fichier, on conserve l'ancien
                $sponsor->setPhoto($anciennePhoto);
            }
    
            $this->entityManager->flush();
            $this->addFlash('success', 'Sponsor mis à jour avec succès');
            return $this->redirectToRoute('sponsor_list');
        }
    
        return $this->render('sponsor/edit.html.twig', [
            'form' => $form->createView(),
            'sponsor' => $sponsor
        ]);
    }
    
}


