<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

use App\Repository\ConferenceRepository;

#[ORM\Entity(repositoryClass: ConferenceRepository::class)]
#[ORM\Table(name: 'conference')]
class Conference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: 'Le titre est obligatoire.')]
    #[Assert\Length(min: 3, max: 255, minMessage: 'Le titre doit comporter au moins {{ limit }} caractères.')]
    private ?string $titre = null;

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    #[Assert\NotBlank(message: 'La date est obligatoire.')]
    #[Assert\Type(type: '\\DateTimeInterface', message: 'Date invalide.')]
    #[Assert\GreaterThanOrEqual('today', message: 'La date doit être dans le futur ou aujourd\'hui.')]
    private ?\DateTimeInterface $date_conference = null;

    public function getDate_conference(): ?\DateTimeInterface
    {
        return $this->date_conference;
    }

    public function setDate_conference(\DateTimeInterface $date_conference): self
    {
        $this->date_conference = $date_conference;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: 'Le présentateur est obligatoire.')]
    private ?string $presenteur = null;

    public function getPresenteur(): ?string
    {
        return $this->presenteur;
    }

    public function setPresenteur(string $presenteur): self
    {
        $this->presenteur = $presenteur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: 'Le lieu est obligatoire.')]
    private ?string $lieu = null;

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    #[Assert\NotBlank(message: 'Le nombre de places est obligatoire.')]
    #[Assert\Positive(message: 'Le nombre de places doit être positif.')]
    private ?int $nb_place = null;

    public function getNb_place(): ?int
    {
        return $this->nb_place;
    }

    public function setNb_place(int $nb_place): self
    {
        $this->nb_place = $nb_place;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    #[Assert\NotBlank(message: 'Le prix est obligatoire.')]
    #[Assert\PositiveOrZero(message: 'Le prix doit être positif ou zéro.')]
    private ?int $prix = null;

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: 'Le thème est obligatoire.')]
    private ?string $theme = null;

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: 'Le statut est obligatoire.')]
    private ?string $status = null;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: 'La ressource est obligatoire.')]
    private ?string $resource = null;

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function setResource(string $resource): self
    {
        $this->resource = $resource;
        return $this;
    }

    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'conference')]
    private Collection $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        if (!$this->inscriptions instanceof Collection) {
            $this->inscriptions = new ArrayCollection();
        }
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->getInscriptions()->contains($inscription)) {
            $this->getInscriptions()->add($inscription);
        }
        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        $this->getInscriptions()->removeElement($inscription);
        return $this;
    }

    public function getDateConference(): ?\DateTimeInterface
    {
        return $this->date_conference;
    }

    public function setDateConference(\DateTimeInterface $date_conference): static
    {
        $this->date_conference = $date_conference;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nb_place;
    }

    public function setNbPlace(int $nb_place): static
    {
        $this->nb_place = $nb_place;

        return $this;
    }

}
