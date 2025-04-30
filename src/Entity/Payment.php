<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\PaymentRepository;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ORM\Table(name: 'payment')]
class Payment
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
    private ?string $payment_type = null;

    public function getPayment_type(): ?string
    {
        return $this->payment_type;
    }

    public function setPayment_type(string $payment_type): self
    {
        $this->payment_type = $payment_type;
        return $this;
    }

    #[ORM\Column(type: 'datetime', nullable: false)]
    private ?\DateTimeInterface $purchase_date = null;

    public function getPurchase_date(): ?\DateTimeInterface
    {
        return $this->purchase_date;
    }

    public function setPurchase_date(\DateTimeInterface $purchase_date): self
    {
        $this->purchase_date = $purchase_date;
        return $this;
    }

    #[ORM\Column(type: 'decimal', nullable: false)]
    private ?float $total_amount = null;

    public function getTotal_amount(): ?float
    {
        return $this->total_amount;
    }

    public function setTotal_amount(float $total_amount): self
    {
        $this->total_amount = $total_amount;
        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->payment_type;
    }

    public function setPaymentType(string $payment_type): static
    {
        $this->payment_type = $payment_type;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTime
    {
        return $this->purchase_date;
    }

    public function setPurchaseDate(\DateTime $purchase_date): static
    {
        $this->purchase_date = $purchase_date;

        return $this;
    }

    public function getTotalAmount(): ?string
    {
        return $this->total_amount;
    }

    public function setTotalAmount(string $total_amount): static
    {
        $this->total_amount = $total_amount;

        return $this;
    }

}
