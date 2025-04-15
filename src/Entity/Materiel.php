<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\MaterielRepository;

#[ORM\Entity(repositoryClass: MaterielRepository::class)]
#[ORM\Table(name: 'materiel')]
class Materiel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
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

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nom_materiel = null;

    public function getNom_materiel(): ?string
    {
        return $this->nom_materiel;
    }

    public function setNom_materiel(string $nom_materiel): self
    {
        $this->nom_materiel = $nom_materiel;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $description = null;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $quantite_dispo = null;

    public function getQuantite_dispo(): ?int
    {
        return $this->quantite_dispo;
    }

    public function setQuantite_dispo(int $quantite_dispo): self
    {
        $this->quantite_dispo = $quantite_dispo;
        return $this;
    }

    #[ORM\OneToMany(targetEntity: ReservationMateriel::class, mappedBy: 'materiel')]
    private Collection $reservationMateriels;

    public function __construct()
    {
        $this->reservationMateriels = new ArrayCollection();
    }

    /**
     * @return Collection<int, ReservationMateriel>
     */
    public function getReservationMateriels(): Collection
    {
        if (!$this->reservationMateriels instanceof Collection) {
            $this->reservationMateriels = new ArrayCollection();
        }
        return $this->reservationMateriels;
    }

    public function addReservationMateriel(ReservationMateriel $reservationMateriel): self
    {
        if (!$this->getReservationMateriels()->contains($reservationMateriel)) {
            $this->getReservationMateriels()->add($reservationMateriel);
        }
        return $this;
    }

    public function removeReservationMateriel(ReservationMateriel $reservationMateriel): self
    {
        $this->getReservationMateriels()->removeElement($reservationMateriel);
        return $this;
    }

    public function getIdMateriel(): ?int
    {
        return $this->id_materiel;
    }

    public function getNomMateriel(): ?string
    {
        return $this->nom_materiel;
    }

    public function setNomMateriel(string $nom_materiel): static
    {
        $this->nom_materiel = $nom_materiel;

        return $this;
    }

    public function getQuantiteDispo(): ?int
    {
        return $this->quantite_dispo;
    }

    public function setQuantiteDispo(int $quantite_dispo): static
    {
        $this->quantite_dispo = $quantite_dispo;

        return $this;
    }

}
