<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


use App\Repository\ReservationMaterielRepository;

#[ORM\Entity(repositoryClass: ReservationMaterielRepository::class)]
#[ORM\Table(name: 'reservation_materiel')]
class ReservationMateriel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_reservation = null;

    public function __construct()
    {
        $this->date_debut = new \DateTime(); // Initialise avec la date actuelle
    }

    public function getId_reservation(): ?int
    {
        return $this->id_reservation;
    }

    public function setId_reservation(int $id_reservation): self
    {
        $this->id_reservation = $id_reservation;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false, options: ['default' => 'CURRENT_DATE'])]
    #[Assert\NotBlank(message: "La date de début est obligatoire.")]
    #[Assert\GreaterThanOrEqual(
        value: "today",
        message: "La date de début doit être aujourd'hui ou dans le futur."
    )]
    #[Assert\NotBlank(message: "The start date cannot be blank.")]
    #[Assert\Type("\DateTimeInterface")]
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
    #[Assert\NotBlank(message: "La date de fin est obligatoire.")]
    #[Assert\NotNull(message: "The end date cannot be null.")]
    #[Assert\Type("\DateTimeInterface")]
    #[Assert\GreaterThan(propertyPath: "date_debut", message: "La date de fin doit être après la date de début.")]
    #[Assert\NotBlank(message: "The end date cannot be blank.")]
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
    #[Assert\NotBlank(message: "La quantité réservée est obligatoire.")]
    #[Assert\Positive(message: "La quantité réservée doit être un nombre positif.")]
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

    #[ORM\ManyToOne(targetEntity: Materiel::class, inversedBy: 'reservationMateriels')]
    #[ORM\JoinColumn(name: 'id_materiel', referencedColumnName: 'id_materiel', nullable: true, onDelete: 'SET NULL')]
    private ?Materiel $materiel = null;

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): self
    {
        $this->materiel = $materiel;
        return $this;
    }

    public function getIdReservation(): ?int
    {
        return $this->id_reservation;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getQuantiteReservee(): ?int
    {
        return $this->quantite_reservee;
    }

    public function setQuantiteReservee(int $quantite_reservee): static
    {
        $this->quantite_reservee = $quantite_reservee;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite_reservee;
    }
    

}