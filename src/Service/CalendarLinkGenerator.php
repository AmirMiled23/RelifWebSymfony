<?php

namespace App\Service;

use App\Entity\ReservationMateriel;

class CalendarLinkGenerator
{
    public function generateLinks(ReservationMateriel $reservation): array
    {
        // Exemple de liens générés pour un calendrier
        return [
            'google' => 'https://calendar.google.com/calendar/render?action=TEMPLATE&text=' . urlencode($reservation->getMateriel()->getNomMateriel()) .
                '&dates=' . $reservation->getDateDebut()->format('Ymd\THis') . '/' . $reservation->getDateFin()->format('Ymd\THis') .
                '&details=' . urlencode('Réservation de matériel') .
                '&location=' . urlencode('Votre entreprise'),
            'outlook' => 'https://outlook.live.com/calendar/0/deeplink/compose?subject=' . urlencode($reservation->getMateriel()->getNomMateriel()) .
                '&startdt=' . $reservation->getDateDebut()->format('Y-m-d\TH:i:s') .
                '&enddt=' . $reservation->getDateFin()->format('Y-m-d\TH:i:s') .
                '&body=' . urlencode('Réservation de matériel'),
        ];
    }
}