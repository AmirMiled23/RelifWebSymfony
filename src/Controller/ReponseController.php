<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Form\ReponseType;
use App\Repository\ReponseRepository;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \DateTime;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[Route('/reponse')]
final class ReponseController extends AbstractController
{
    private $reclamationRepository;

    // Constructor to inject ReclamationRepository
    public function __construct(ReclamationRepository $reclamationRepository)
    {
        $this->reclamationRepository = $reclamationRepository;
    }

    // Display list of responses
    #[Route(name: 'app_reponse_index', methods: ['GET'])]
public function index(Request $request, ReponseRepository $reponseRepository): Response
{
    // Get sorting parameters from the query string
    $sort = $request->query->get('sort', 'id_reclamation'); // Default sort by ID
    $direction = $request->query->get('direction', 'asc'); // Default direction is ascending

    // Validate sorting column and direction
    $validSortColumns = ['id_reclamation', 'status', 'type'];
    if (!in_array($sort, $validSortColumns)) {
        $sort = 'id_reclamation';
    }
    if (!in_array($direction, ['asc', 'desc'])) {
        $direction = 'asc';
    }

    // Fetch sorted reclamations
    $reclamations = $this->reclamationRepository->findBy([], [$sort => $direction]);

    return $this->render('reponse/index.html.twig', [
        'reponses' => $reponseRepository->findAll(),
        'reclamations' => $reclamations,
        'sort' => $sort,
        'direction' => $direction,
    ]);
}

#[Route('/new/{id_reclamation}', name: 'app_reponse_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager, int $id_reclamation, MailerInterface $mailer): Response
{
    $reclamation = $this->reclamationRepository->find($id_reclamation);
    if (!$reclamation) {
        throw $this->createNotFoundException('Réclamation non trouvée.');
    }

    $reponse = new Reponse();
    $reponse->setReclamation($reclamation);

    $form = $this->createForm(ReponseType::class, $reponse);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($reponse);
        $reclamation->setStatus('In Progress');
        $entityManager->flush();

        $email = (new Email())
            ->from('jaafer.bbj@gmail.com')
            ->to('ritakozak25@gmail.com')
            ->subject('Nouvelle réponse à votre réclamation')
            ->text('Une réponse a été ajoutée à votre réclamation : ' . ($reponse->getDescription() ?: 'No description available'));

        try {
            $mailer->send($email);
            dump('Mail envoyé avec succès');
        } catch (\Exception $e) {
            dump('Erreur d’envoi : ' . $e->getMessage());
        }

        return $this->redirectToRoute('app_reponse_index');
    }

    return $this->render('reponse/new.html.twig', [
        'reponse' => $reponse,
        'form' => $form,
    ]);
}

        

    // Display a single response and all related reclamations
    #[Route('/{id}', name: 'app_reponse_show', methods: ['GET'])]
    public function show(Reponse $reponse): Response
    {
        // Fetch all reclamations for the "show" page
        $reclamations = $this->reclamationRepository->findAll();

        return $this->render('reponse/show.html.twig', [
            'reponse' => $reponse,
            'reclamations' => $reclamations,
        ]);
    }

    // Handle editing a response
    #[Route('/{id}/edit', name: 'app_reponse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        // Create and handle the edit form
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Save the changes
            $entityManager->flush();

            // Redirect to the response list after successful update
            return $this->redirectToRoute('app_reponse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reponse/edit.html.twig', [
            'reponse' => $reponse,
            'form' => $form,
        ]);
    }

    // Handle deleting a response
    #[Route('/{id}', name: 'app_reponse_delete', methods: ['POST'])]
    public function delete(Request $request, Reponse $reponse, EntityManagerInterface $entityManager): Response
    {
        // Verify CSRF token
        if ($this->isCsrfTokenValid('delete'.$reponse->getId(), $request->request->get('_token'))) {
            // Remove the response from the database
            $entityManager->remove($reponse);
            $entityManager->flush();
        }

        // Redirect to the response list after successful deletion
        return $this->redirectToRoute('app_reponse_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/reponse/statistics', name: 'app_reclamation_statistics', methods: ['GET'])]
    public function statistics(ReclamationRepository $reclamationRepository): Response
{
    // Fetch data
    $total = $reclamationRepository->count([]);
    $pending = $reclamationRepository->count(['status' => 'Pending']);
    $resolved = $reclamationRepository->count(['status' => 'Resolved']);
    $rejected = $reclamationRepository->count(['status' => 'Rejected']);

    // Calculate percentages
    $pendingPercentage = $total > 0 ? ($pending / $total) * 100 : 0;
    $resolvedPercentage = $total > 0 ? ($resolved / $total) * 100 : 0;
    $rejectedPercentage = $total > 0 ? ($rejected / $total) * 100 : 0;

    return $this->render('reponse/statistics.html.twig', [
        'total' => $total,
        'pendingPercentage' => $pendingPercentage,
        'resolvedPercentage' => $resolvedPercentage,
        'rejectedPercentage' => $rejectedPercentage,
    ]);
}
//monthly statistics
#[Route('/reponse/statistics/monthly', name: 'app_reclamation_monthly_statistics', methods: ['GET'])]
public function monthlyTrends(Connection $connection): Response
{
    // Native SQL query to count reclamations grouped by month
    $sql = '
        SELECT MONTH(created_at) AS month, COUNT(id_reclamation) AS count
        FROM reclamation
        WHERE created_at IS NOT NULL
        GROUP BY month
        ORDER BY month ASC
    ';

    // Execute the query
    $results = $connection->fetchAllAssociative($sql);

    // Prepare data for the chart
    $months = [];
    $counts = [];
    foreach ($results as $result) {
        // Ensure the month value is valid
        if ($result['month'] !== null) {
            $months[] = DateTime::createFromFormat('!m', $result['month'])->format('F'); // Convert month number to name
            $counts[] = $result['count'];
        }
    }

    return $this->render('reponse/statistics_monthly.html.twig', [
        'months' => $months,
        'counts' => $counts,
    ]);
}

#[Route('/reclamation/count', name: 'app_reclamation_count', methods: ['GET'])]
public function count(EntityManagerInterface $entityManager): JsonResponse
{
    $count = $entityManager->getRepository(Reclamation::class)->count([]);
    return new JsonResponse(['count' => $count]);
}


}