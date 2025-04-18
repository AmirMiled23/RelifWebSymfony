<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\CategorieEventRepository;

#[ORM\Entity(repositoryClass: CategorieEventRepository::class)]
#[ORM\Table(name: 'categorie_event')]
class CategorieEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_categorie = null;

    public function getId_categorie(): ?int
    {
        return $this->id_categorie;
    }

    public function setId_categorie(int $id_categorie): self
    {
        $this->id_categorie = $id_categorie;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nom_categorie = null;

    public function getNom_categorie(): ?string
    {
        return $this->nom_categorie;
    }

    public function setNom_categorie(string $nom_categorie): self
    {
        $this->nom_categorie = $nom_categorie;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $image = null;

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $description = null;

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'categorieEvent')]
    private Collection $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        if (!$this->events instanceof Collection) {
            $this->events = new ArrayCollection();
        }
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->getEvents()->contains($event)) {
            $this->getEvents()->add($event);
        }
        return $this;
    }

    public function removeEvent(Event $event): self
    {
        $this->getEvents()->removeElement($event);
        return $this;
    }

    public function getIdCategorie(): ?int
    {
        return $this->id_categorie;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nom_categorie;
    }

    public function setNomCategorie(string $nom_categorie): static
    {
        $this->nom_categorie = $nom_categorie;

        return $this;
    }

}
