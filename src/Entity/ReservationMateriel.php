<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\ReservationMaterielRepository;

#[ORM\Entity(repositoryClass: ReservationMaterielRepository::class)]
#[ORM\Table(name: 'reservation_materiel')]
class ReservationMateriel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_reservation = null;

    public function getId_reservation(): ?int
    {
        return $this->id_reservation;
    }

    public function setId_reservation(int $id_reservation): self
    {
        $this->id_reservation = $id_reservation;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_debut = null;

    public function getDate_debut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDate_debut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_fin = null;

    public function getDate_fin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDate_fin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $quantite_reservee = null;

    public function getQuantite_reservee(): ?int
    {
        return $this->quantite_reservee;
    }

    public function setQuantite_reservee(int $quantite_reservee): self
    {
        $this->quantite_reservee = $quantite_reservee;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $id_materiel = null;

    public function getId_materiel(): ?int
    {
        return $this->id_materiel;
    }

    public function setId_materiel(int $id_materiel): self
    {
        $this->id_materiel = $id_materiel;
        return $this;
    }

}
