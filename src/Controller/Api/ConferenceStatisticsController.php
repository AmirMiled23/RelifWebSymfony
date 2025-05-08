<?php

namespace App\Controller\Api;

use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ConferenceStatisticsController extends AbstractController
{
    #[Route('/api/conference/statistics', name: 'api_conference_statistics')]
    public function getStatistics(ConferenceRepository $conferenceRepository): JsonResponse
    {
        // Get all conferences
        $conferences = $conferenceRepository->findAll();
        
        // Process monthly data
        $monthlyData = $this->getMonthlyData($conferences);
        
        // Process status data
        $statusData = $this->getStatusData($conferences);
        
        // Process theme data
        $themeData = $this->getThemeData($conferences);
        
        // Process location data
        $locationData = $this->getLocationData($conferences);
        
        // Process revenue data
        $revenueData = $this->getRevenueData($conferences);
        
        return $this->json([
            'monthly' => $monthlyData,
            'status' => $statusData,
            'themes' => $themeData,
            'locations' => $locationData,
            'revenue' => $revenueData
        ]);
    }
    
    private function getMonthlyData(array $conferences): array
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $conferenceCounts = array_fill(0, 12, 0);
        
        foreach ($conferences as $conference) {
            $date = $conference->getDateConference();
            if ($date) {
                $month = (int)$date->format('n') - 1; // 0-based index for months
                $conferenceCounts[$month]++;
            }
        }
        
        return [
            'labels' => $months,
            'conferences' => $conferenceCounts
        ];
    }
    
    private function getStatusData(array $conferences): array
    {
        $statusCounts = [
            'En cours' => 0,
            'Pas encore' => 0,
            'Autres' => 0
        ];
        
        foreach ($conferences as $conference) {
            $status = $conference->getStatus();
            
            if (isset($statusCounts[$status])) {
                $statusCounts[$status]++;
            } else {
                $statusCounts['Autres']++;
            }
        }
        
        return [
            'labels' => array_keys($statusCounts),
            'counts' => array_values($statusCounts)
        ];
    }
    
    private function getThemeData(array $conferences): array
    {
        $themeCounts = [];
        
        foreach ($conferences as $conference) {
            $theme = $conference->getTheme();
            
            if (!isset($themeCounts[$theme])) {
                $themeCounts[$theme] = 0;
            }
            
            $themeCounts[$theme]++;
        }
        
        // Sort by count descending
        arsort($themeCounts);
        
        // Take top 6 themes and group others
        if (count($themeCounts) > 6) {
            $topThemes = array_slice($themeCounts, 0, 6, true);
            $others = array_sum(array_slice($themeCounts, 6, null, true));
            $topThemes['Others'] = $others;
            $themeCounts = $topThemes;
        }
        
        return [
            'labels' => array_keys($themeCounts),
            'counts' => array_values($themeCounts)
        ];
    }
    
    private function getLocationData(array $conferences): array
    {
        $locationCounts = [];
        
        foreach ($conferences as $conference) {
            $location = $conference->getLieu();
            
            if (!isset($locationCounts[$location])) {
                $locationCounts[$location] = 0;
            }
            
            $locationCounts[$location]++;
        }
        
        // Sort by count descending
        arsort($locationCounts);
        
        // Take top 7 locations and group others
        if (count($locationCounts) > 7) {
            $topLocations = array_slice($locationCounts, 0, 7, true);
            $others = array_sum(array_slice($locationCounts, 7, null, true));
            $topLocations['Others'] = $others;
            $locationCounts = $topLocations;
        }
        
        return [
            'labels' => array_keys($locationCounts),
            'counts' => array_values($locationCounts)
        ];
    }
    
    private function getRevenueData(array $conferences): array
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthlyRevenue = array_fill(0, 12, 0);
        $themeRevenue = [];
        
        foreach ($conferences as $conference) {
            $date = $conference->getDateConference();
            $price = $conference->getPrix() ?? 0;
            $nbPlaces = $conference->getNbPlace() ?? 0;
            $theme = $conference->getTheme();
            
            // Calculate estimated revenue (price * number of places)
            $estimatedRevenue = $price * $nbPlaces;
            
            // Add to monthly revenue
            if ($date) {
                $month = (int)$date->format('n') - 1; // 0-based index for months
                $monthlyRevenue[$month] += $estimatedRevenue;
            }
            
            // Add to theme revenue
            if (!isset($themeRevenue[$theme])) {
                $themeRevenue[$theme] = 0;
            }
            $themeRevenue[$theme] += $estimatedRevenue;
        }
        
        // Sort theme revenue by value descending
        arsort($themeRevenue);
        
        // Take top 5 themes by revenue and group others
        if (count($themeRevenue) > 5) {
            $topThemes = array_slice($themeRevenue, 0, 5, true);
            $others = array_sum(array_slice($themeRevenue, 5, null, true));
            $topThemes['Others'] = $others;
            $themeRevenue = $topThemes;
        }
        
        return [
            'monthly' => [
                'labels' => $months,
                'values' => $monthlyRevenue
            ],
            'byTheme' => [
                'labels' => array_keys($themeRevenue),
                'values' => array_values($themeRevenue)
            ]
        ];
    }
}
