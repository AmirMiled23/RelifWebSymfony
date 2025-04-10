<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_user = null;

    public function getId_user(): ?int
    {
        return $this->id_user;
    }

    public function setId_user(int $id_user): self
    {
        $this->id_user = $id_user;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nom_user = null;

    public function getNom_user(): ?string
    {
        return $this->nom_user;
    }

    public function setNom_user(string $nom_user): self
    {
        $this->nom_user = $nom_user;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $prenom_user = null;

    public function getPrenom_user(): ?string
    {
        return $this->prenom_user;
    }

    public function setPrenom_user(string $prenom_user): self
    {
        $this->prenom_user = $prenom_user;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $email_user = null;

    public function getEmail_user(): ?string
    {
        return $this->email_user;
    }

    public function setEmail_user(string $email_user): self
    {
        $this->email_user = $email_user;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $num_user = null;

    public function getNum_user(): ?int
    {
        return $this->num_user;
    }

    public function setNum_user(int $num_user): self
    {
        $this->num_user = $num_user;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $adresse_user = null;

    public function getAdresse_user(): ?string
    {
        return $this->adresse_user;
    }

    public function setAdresse_user(string $adresse_user): self
    {
        $this->adresse_user = $adresse_user;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $age_user = null;

    public function getAge_user(): ?int
    {
        return $this->age_user;
    }

    public function setAge_user(int $age_user): self
    {
        $this->age_user = $age_user;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $point_user = null;

    public function getPoint_user(): ?int
    {
        return $this->point_user;
    }

    public function setPoint_user(?int $point_user): self
    {
        $this->point_user = $point_user;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $pw_user = null;

    public function getPw_user(): ?string
    {
        return $this->pw_user;
    }

    public function setPw_user(string $pw_user): self
    {
        $this->pw_user = $pw_user;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_inscri = null;

    public function getDate_inscri(): ?\DateTimeInterface
    {
        return $this->date_inscri;
    }

    public function setDate_inscri(\DateTimeInterface $date_inscri): self
    {
        $this->date_inscri = $date_inscri;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $reset_code = null;

    public function getReset_code(): ?int
    {
        return $this->reset_code;
    }

    public function setReset_code(?int $reset_code): self
    {
        $this->reset_code = $reset_code;
        return $this;
    }

    #[ORM\OneToMany(targetEntity: Aviss::class, mappedBy: 'user')]
    private Collection $avisss;

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

    #[ORM\OneToMany(targetEntity: Userprofil::class, mappedBy: 'user')]
    private Collection $userprofils;

    /**
     * @return Collection<int, Userprofil>
     */
    public function getUserprofils(): Collection
    {
        if (!$this->userprofils instanceof Collection) {
            $this->userprofils = new ArrayCollection();
        }
        return $this->userprofils;
    }

    public function addUserprofil(Userprofil $userprofil): self
    {
        if (!$this->getUserprofils()->contains($userprofil)) {
            $this->getUserprofils()->add($userprofil);
        }
        return $this;
    }

    public function removeUserprofil(Userprofil $userprofil): self
    {
        $this->getUserprofils()->removeElement($userprofil);
        return $this;
    }

}
