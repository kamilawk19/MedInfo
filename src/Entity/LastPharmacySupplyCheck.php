<?php

namespace App\Entity;

use App\Repository\LastPharmacySupplyCheckRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LastPharmacySupplyCheckRepository::class)]
class LastPharmacySupplyCheck
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Last_Supply_Date = null;

    #[ORM\ManyToOne(inversedBy: 'lastPharmacySupplyChecks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ID_Controller = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastSupplyDate(): ?\DateTimeInterface
    {
        return $this->Last_Supply_Date;
    }

    public function setLastSupplyDate(\DateTimeInterface $Last_Supply_Date): self
    {
        $this->Last_Supply_Date = $Last_Supply_Date;

        return $this;
    }

    public function getIDController(): ?User
    {
        return $this->ID_Controller;
    }

    public function setIDController(?User $ID_Controller): self
    {
        $this->ID_Controller = $ID_Controller;

        return $this;
    }
}
