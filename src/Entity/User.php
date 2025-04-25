<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user')]
#[UniqueEntity(fields: ['email_user'], message: "Il existe déjà un compte avec cet email.")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_user = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    private ?string $nom_user = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    private ?string $prenom_user = null;

    #[ORM\Column(type: 'string', length: 180, unique: true, nullable: false)]
    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[Assert\Email(message: "L'email '{{ value }}' n'est pas valide.")]
    private ?string $email_user = null;

    #[ORM\Column(type: 'string', length: 8, nullable: false)]
    #[Assert\NotBlank(message: "Le numéro de téléphone est obligatoire.")]
    #[Assert\Regex(pattern: '/^[0-9]{8}$/', message: "Le numéro de téléphone doit comporter exactement 8 chiffres.")]
    private ?string $num_user = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(message: "L'adresse est obligatoire.")]
    private ?string $adresse_user = null;

    #[ORM\Column(type: 'integer', nullable: false)]
    #[Assert\NotBlank(message: "L'âge est obligatoire.")]
    #[Assert\Positive(message: "L'âge doit être un nombre positif.")]
    #[Assert\Range(min: 1, max: 120, notInRangeMessage: "L'âge doit être compris entre {{ min }} et {{ max }} ans.")]
    private ?int $age_user = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $point_user = 0;

    #[ORM\Column(type: 'string', nullable: false)]
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire.")]
    #[Assert\Length(min: 8, minMessage: "Le mot de passe doit contenir au moins {{ limit }} caractères.")]
    private ?string $pw_user = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $date_inscri = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $reset_code = null;

    #[ORM\OneToMany(targetEntity: Avi::class, mappedBy: 'user')]
    private Collection $avis;

    #[ORM\OneToMany(targetEntity: Userprofil::class, mappedBy: 'user')]
    private Collection $userprofils;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
        $this->userprofils = new ArrayCollection();
        $this->date_inscri = new \DateTime();
        $this->point_user = 0;
    }
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
private ?string $token = null;

public function getToken(): ?string
{
    return $this->token;
}

public function setToken(?string $token): self
{
    $this->token = $token;
    return $this;
}

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
    public function eraseCredentials(): void
    {
        // Exemple: $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email_user;
    }

    public function getPassword(): ?string
    {
        return $this->pw_user;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function getNomUser(): ?string
    {
        return $this->nom_user;
    }

    public function setNomUser(string $nom_user): self
    {
        $this->nom_user = $nom_user;
        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenom_user;
    }

    public function setPrenomUser(string $prenom_user): self
    {
        $this->prenom_user = $prenom_user;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->pw_user = $password;
        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->email_user;
    }

    public function setEmailUser(string $email_user): self
    {
        $this->email_user = $email_user;
        return $this;
    }

    public function getNumUser(): ?string
    {
        return $this->num_user;
    }

    public function setNumUser(string $num_user): self
    {
        $this->num_user = $num_user;
        return $this;
    }

    public function getAdresseUser(): ?string
    {
        return $this->adresse_user;
    }

    public function setAdresseUser(string $adresse_user): self
    {
        $this->adresse_user = $adresse_user;
        return $this;
    }

    public function getAgeUser(): ?int
    {
        return $this->age_user;
    }

    public function setAgeUser(int $age_user): self
    {
        $this->age_user = $age_user;
        return $this;
    }

    public function getPointUser(): ?int
    {
        return $this->point_user;
    }

    public function setPointUser(?int $point_user): self
    {
        $this->point_user = $point_user;
        return $this;
    }

    public function getPwUser(): ?string
    {
        return $this->pw_user;
    }

    public function setPwUser(string $pw_user): self
    {
        $this->pw_user = $pw_user;
        return $this;
    }

    public function getDateInscri(): ?\DateTimeInterface
    {
        return $this->date_inscri;
    }

    public function setDateInscri(\DateTimeInterface $date_inscri): self
    {
        $this->date_inscri = $date_inscri;
        return $this;
    }

    public function getResetCode(): ?int
    {
        return $this->reset_code;
    }

    public function setResetCode(?int $reset_code): self
    {
        $this->reset_code = $reset_code;
        return $this;
    }

    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avi $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
        }
        return $this;
    }

    public function removeAvi(Avi $avi): self
    {
        $this->avis->removeElement($avi);
        return $this;
    }

    public function getUserprofils(): Collection
    {
        return $this->userprofils;
    }

    public function addUserprofil(Userprofil $userprofil): self
    {
        if (!$this->userprofils->contains($userprofil)) {
            $this->userprofils->add($userprofil);
        }
        return $this;
    }

    public function removeUserprofil(Userprofil $userprofil): self
    {
        $this->userprofils->removeElement($userprofil);
        return $this;
 
   }


public function setRoles(array $roles): self
{
    $this->roles = $roles;
    return $this;
}

}