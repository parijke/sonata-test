<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvoiceRepository")
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $invoicedate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InvoiceItem", mappedBy="invoice", orphanRemoval=true, cascade={"persist"})
     */
    private $invoiceitems;

    private $total;

    public function __construct()
    {
        $this->invoiceitems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoicedate(): ?\DateTimeInterface
    {
        dump($this->invoicedate);
        return $this->invoicedate;
    }

    public function setInvoicedate(\DateTimeInterface $invoicedate): self
    {
        $this->invoicedate = $invoicedate;
        dump($this->invoicedate);

        return $this;
    }

    /**
     * @return Collection|InvoiceItem[]
     */
    public function getInvoiceItems(): Collection
    {
        return $this->invoiceitems;
    }

    public function setTotal(float $total) {
    }

    public function getTotal() {

        $sum = 0.00;
        foreach($this->invoiceitems as $item) {
            $sum = bcadd($sum , $item->getTotal(),2);
//            dd($sum);
        }
        return $sum;
    }

    public function addInvoiceItem(InvoiceItem $invoiceitem): self
    {
        if (!$this->invoiceitems->contains($invoiceitem)) {
            $this->invoiceitems[] = $invoiceitem;
            $invoiceitem->setInvoice($this);
        }

        return $this;
    }

    public function removeInvoiceItem(InvoiceItem $invoiceitem): self
    {
        if ($this->invoiceitems->contains($invoiceitem)) {
            $this->invoiceitems->removeElement($invoiceitem);
            // set the owning side to null (unless already changed)
            if ($invoiceitem->getInvoice() === $this) {
                $invoiceitem->setInvoice(null);
            }
        }

        return $this;
    }
}
