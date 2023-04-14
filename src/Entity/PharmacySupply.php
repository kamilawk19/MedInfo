<?php

namespace App\Entity;

use App\Repository\PharmacySupplyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PharmacySupplyRepository::class)]
class PharmacySupply
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Name = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $International_Name = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?int $Quantity = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Exp_Date = null;

    #[ORM\Column]
    private ?bool $Drug_List_N = null;

    #[ORM\OneToMany(mappedBy: 'FK_Medicine', targetEntity: Medicines::class)]
    private Collection $medicines;

    public function __construct()
    {
        $this->medicines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString() {
        return (string) $this->getId();
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getInternationalName(): ?string
    {
        return $this->International_Name;
    }

    public function setInternationalName(?string $International_Name): self
    {
        $this->International_Name = $International_Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getExpDate(): ?\DateTimeInterface
    {
        return $this->Exp_Date;
    }

    public function setExpDate(\DateTimeInterface $Exp_Date): self
    {
        $this->Exp_Date = $Exp_Date;

        return $this;
    }

    public function isDrugListN(): ?bool
    {
        return $this->Drug_List_N;
    }

    public function setDrugListN(bool $Drug_List_N): self
    {
        $this->Drug_List_N = $Drug_List_N;

        return $this;
    }

    /**
     * @return Collection<int, Medicines>
     */
    public function getMedicines(): Collection
    {
        return $this->medicines;
    }

    public function addMedicine(Medicines $medicine): self
    {
        if (!$this->medicines->contains($medicine)) {
            $this->medicines->add($medicine);
            $medicine->setFKMedicine($this);
        }

        return $this;
    }

    public function removeMedicine(Medicines $medicine): self
    {
        if ($this->medicines->removeElement($medicine)) {
            // set the owning side to null (unless already changed)
            if ($medicine->getFKMedicine() === $this) {
                $medicine->setFKMedicine(null);
            }
        }

        return $this;
    }
}
