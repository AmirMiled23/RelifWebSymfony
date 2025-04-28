<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\UserprofilRepository;

#[ORM\Entity(repositoryClass: UserprofilRepository::class)]
#[ORM\Table(name: 'userprofil')]
class Userprofil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_profil = null;

    public function getId_profil(): ?int
    {
        return $this->id_profil;
    }

    public function setId_profil(int $id_profil): self
    {
        $this->id_profil = $id_profil;
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

    #[ORM\Column(type: 'text', nullable: false)]
    private ?string $preferance = null;

    public function getPreferance(): ?string
    {
        return $this->preferance;
    }

    public function setPreferance(string $preferance): self
    {
        $this->preferance = $preferance;
        return $this;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userprofils')]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id_user')]
    private ?User $user = null;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

}
