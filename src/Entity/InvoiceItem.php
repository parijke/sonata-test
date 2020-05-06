<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceItemRepository")
 */
class InvoiceItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Invoice", inversedBy="invoiceitems", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $invoice;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $count;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $vat;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $price;

    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(){

        return  $this->count * $this->price;
    }

    public function setTotal(float $total){
        $this->total = $this->count * $this->price;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function __toString()
    {
       return $this->getDescription();
    }

    public function getCount(): ?string
    {
        return $this->count;
    }

    public function setCount(string $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function setVat(string $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
