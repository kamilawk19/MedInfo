<?php

namespace App\Entity;

use App\Repository\MedicinesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicinesRepository::class)]
class Medicines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $Dose = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Additional_Info = null;

    #[ORM\ManyToOne(inversedBy: 'medicines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dialysis $ID_Dialysis = null;

    #[ORM\ManyToOne(inversedBy: 'medicines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PharmacySupply $FK_Medicine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDose(): ?string
    {
        return $this->Dose;
    }

    public function setDose(string $Dose): self
    {
        $this->Dose = $Dose;

        return $this;
    }

    public function getAdditionalInfo(): ?string
    {
        return $this->Additional_Info;
    }

    public function setAdditionalInfo(?string $Additional_Info): self
    {
        $this->Additional_Info = $Additional_Info;

        return $this;
    }

    public function getIDDialysis(): ?Dialysis
    {
        return $this->ID_Dialysis;
    }

    public function setIDDialysis(?Dialysis $ID_Dialysis): self
    {
        $this->ID_Dialysis = $ID_Dialysis;

        return $this;
    }

    public function getFKMedicine(): ?PharmacySupply
    {
        return $this->FK_Medicine;
    }

    public function setFKMedicine(?PharmacySupply $FK_Medicine): self
    {
        $this->FK_Medicine = $FK_Medicine;

        return $this;
    }
}
