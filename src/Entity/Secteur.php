<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\SecteurRepository;

#[ORM\Entity(repositoryClass: SecteurRepository::class)]
#[ORM\Table(name: 'secteur')]
class Secteur
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

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $nom = null;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
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

    #[ORM\OneToMany(targetEntity: Sponsor::class, mappedBy: 'secteur')]
    private Collection $sponsors;

    /**
     * @return Collection<int, Sponsor>
     */
    public function getSponsors(): Collection
    {
        if (!$this->sponsors instanceof Collection) {
            $this->sponsors = new ArrayCollection();
        }
        return $this->sponsors;
    }

    public function addSponsor(Sponsor $sponsor): self
    {
        if (!$this->getSponsors()->contains($sponsor)) {
            $this->getSponsors()->add($sponsor);
        }
        return $this;
    }

    public function removeSponsor(Sponsor $sponsor): self
    {
        $this->getSponsors()->removeElement($sponsor);
        return $this;
    }

}
