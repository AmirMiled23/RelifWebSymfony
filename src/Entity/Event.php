<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\EventRepository;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'event')]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_event = null;

    public function getId_event(): ?int
    {
        return $this->id_event;
    }

    public function setId_event(int $id_event): self
    {
        $this->id_event = $id_event;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nom_event = null;

    public function getNom_event(): ?string
    {
        return $this->nom_event;
    }

    public function setNom_event(string $nom_event): self
    {
        $this->nom_event = $nom_event;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $date_event = null;

    public function getDate_event(): ?\DateTimeInterface
    {
        return $this->date_event;
    }

    public function setDate_event(?\DateTimeInterface $date_event): self
    {
        $this->date_event = $date_event;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $adresse_event = null;

    public function getAdresse_event(): ?string
    {
        return $this->adresse_event;
    }

    public function setAdresse_event(string $adresse_event): self
    {
        $this->adresse_event = $adresse_event;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $villes = null;

    public function getVilles(): ?string
    {
        return $this->villes;
    }

    public function setVilles(string $villes): self
    {
        $this->villes = $villes;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $description_event = null;

    public function getDescription_event(): ?string
    {
        return $this->description_event;
    }

    public function setDescription_event(?string $description_event): self
    {
        $this->description_event = $description_event;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $status_event = null;

    public function getStatus_event(): ?string
    {
        return $this->status_event;
    }

    public function setStatus_event(?string $status_event): self
    {
        $this->status_event = $status_event;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $nb_participant_max = null;

    public function getNb_participant_max(): ?int
    {
        return $this->nb_participant_max;
    }

    public function setNb_participant_max(?int $nb_participant_max): self
    {
        $this->nb_participant_max = $nb_participant_max;
        return $this;
    }

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'events')]
    #[ORM\JoinColumn(name: 'id_categorie', referencedColumnName: 'id_categorie')]
    private ?Categorie $categorie = null;

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }

    #[ORM\OneToMany(targetEntity: Avi::class, mappedBy: 'event')]
    private Collection $avis;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
    }

    /**
     * @return Collection<int, Avi>
     */
    public function getAvis(): Collection
    {
        if (!$this->avis instanceof Collection) {
            $this->avis = new ArrayCollection();
        }
        return $this->avis;
    }

    public function addAvi(Avi $avi): self
    {
        if (!$this->getAvis()->contains($avi)) {
            $this->getAvis()->add($avi);
        }
        return $this;
    }

    public function removeAvi(Avi $avi): self
    {
        $this->getAvis()->removeElement($avi);
        return $this;
    }

    public function getIdEvent(): ?int
    {
        return $this->id_event;
    }

    public function getNomEvent(): ?string
    {
        return $this->nom_event;
    }

    public function setNomEvent(string $nom_event): static
    {
        $this->nom_event = $nom_event;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->date_event;
    }

    public function setDateEvent(?\DateTimeInterface $date_event): static
    {
        $this->date_event = $date_event;

        return $this;
    }

    public function getAdresseEvent(): ?string
    {
        return $this->adresse_event;
    }

    public function setAdresseEvent(string $adresse_event): static
    {
        $this->adresse_event = $adresse_event;

        return $this;
    }

    public function getDescriptionEvent(): ?string
    {
        return $this->description_event;
    }

    public function setDescriptionEvent(?string $description_event): static
    {
        $this->description_event = $description_event;

        return $this;
    }

    public function getStatusEvent(): ?string
    {
        return $this->status_event;
    }

    public function setStatusEvent(?string $status_event): static
    {
        $this->status_event = $status_event;

        return $this;
    }

    public function getNbParticipantMax(): ?int
    {
        return $this->nb_participant_max;
    }

    public function setNbParticipantMax(?int $nb_participant_max): static
    {
        $this->nb_participant_max = $nb_participant_max;

        return $this;
    }

}
