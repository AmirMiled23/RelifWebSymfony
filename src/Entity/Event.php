<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\NotBlank(message: "Le nom de l'événement est obligatoire.")]
    #[Assert\Length(
        min: 5,
        minMessage: "Le nom doit contenir au moins {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: "/^[^\d]/",
        message: "Le nom ne doit pas commencer par un chiffre."
    )]
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

    #[ORM\Column(type: 'date', nullable: false)]
    #[Assert\NotNull(message: "La date de l'événement est obligatoire.")]
    #[Assert\GreaterThanOrEqual("today", message: "Pas une date au passé.")]
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
    #[Assert\NotBlank(message: "L'adresse de l'événement est obligatoire.")]
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

    #[ORM\Column(type: 'string', length:50,nullable: false)]
    #[Assert\NotBlank(message: "La ville est obligatoire.")]
    private ?string $villes = null;

    public function getVilles(): ?string
    {
        return $this->villes;
    }

    public function setVilles(?string $villes): self
    {
        $this->villes = $villes;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: "La description est obligatoire.")]
    #[Assert\Length(
        min: 5,
        minMessage: "La description doit contenir au moins {{ limit }} caractères."
    )]
    #[Assert\Regex(
        pattern: "/^[^\d]/",
        message: "La description ne doit pas commencer par un chiffre."
    )]
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

    #[ORM\Column(type: 'string', length:20)]
    #[Assert\NotBlank(message: "Le statut est obligatoire.")]
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

    #[ORM\Column(type: 'integer', nullable: false)]
    #[Assert\NotNull(message: "Le nombre maximal de participants est obligatoire.")]
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

    #[ORM\ManyToOne(targetEntity: CategorieEvent::class, inversedBy: 'events')]
    #[ORM\JoinColumn(name: 'id_categorie', referencedColumnName: 'id_categorie',nullable:false)]
    #[Assert\NotNull(message: "La catégorie est obligatoire.")]
    private ?CategorieEvent $categorieEvent = null;

    public function getCategorieEvent(): ?CategorieEvent
    {
        return $this->categorieEvent;
    }

    public function setCategorieEvent(?CategorieEvent $categorieEvent): self
    {
        $this->categorieEvent = $categorieEvent;
        return $this;
    }

    #[ORM\OneToMany(targetEntity: Aviss::class, mappedBy: 'event')]
    private Collection $avisss;

    public function __construct()
    {
        $this->avisss = new ArrayCollection();
    }

    /**
     * @return Collection<int, Aviss>
     */
    public function getAvisss(): Collection
    {
        if (!$this->avisss instanceof Collection) {
            $this->avisss = new ArrayCollection();
        }
        return $this->avisss;
    }

    public function addAviss(Aviss $aviss): self
    {
        if (!$this->getAvisss()->contains($aviss)) {
            $this->getAvisss()->add($aviss);
        }
        return $this;
    }

    public function removeAviss(Aviss $aviss): self
    {
        $this->getAvisss()->removeElement($aviss);
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

    public function addAvisss(Aviss $avisss): static
    {
        if (!$this->avisss->contains($avisss)) {
            $this->avisss->add($avisss);
            $avisss->setEvent($this);
        }

        return $this;
    }

    public function removeAvisss(Aviss $avisss): static
    {
        if ($this->avisss->removeElement($avisss)) {
           
            if ($avisss->getEvent() === $this) {
                $avisss->setEvent(null);
            }
        }

        return $this;
    }

    #[ORM\Column(type: 'boolean')]
    private bool $assignedToCalendar = false;

    public function isAssignedToCalendar(): bool
    {
        return $this->assignedToCalendar;
    }

    public function setAssignedToCalendar(bool $assignedToCalendar): self
    {
        $this->assignedToCalendar = $assignedToCalendar;

        return $this;
    }
}
