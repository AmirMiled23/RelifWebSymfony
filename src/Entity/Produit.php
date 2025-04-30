<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\ProduitRepository;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ORM\Table(name: 'produit')]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_equip = null;

    public function getId_equip(): ?int
    {
        return $this->id_equip;
    }

    public function setId_equip(int $id_equip): self
    {
        $this->id_equip = $id_equip;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nom = null;

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    #[ORM\Column(type: 'decimal', nullable: false)]
    private ?float $prix = null;

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $stock = null;

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $image_url = null;

    public function getImage_url(): ?string
    {
        return $this->image_url;
    }

    public function setImage_url(?string $image_url): self
    {
        $this->image_url = $image_url;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $category = null;

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    #[ORM\OneToMany(targetEntity: Cart::class, mappedBy: 'produit')]
    private Collection $carts;

    public function __construct()
    {
        $this->carts = new ArrayCollection();
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        if (!$this->carts instanceof Collection) {
            $this->carts = new ArrayCollection();
        }
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->getCarts()->contains($cart)) {
            $this->getCarts()->add($cart);
        }
        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        $this->getCarts()->removeElement($cart);
        return $this;
    }

    public function getIdEquip(): ?int
    {
        return $this->id_equip;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): static
    {
        $this->image_url = $image_url;

        return $this;
    }

}
