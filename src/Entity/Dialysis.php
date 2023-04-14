<?php

namespace App\Entity;

use App\Repository\DialysisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DialysisRepository::class)]
class Dialysis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2, nullable: true)]
    private ?string $Weight_Before = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2, nullable: true)]
    private ?string $Weight_After = null;

    #[ORM\Column(length: 7, nullable: true)]
    private ?string $Blood_Pressure_Before = null;

    #[ORM\Column(length: 7, nullable: true)]
    private ?string $Blood_Pressure_After = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Pressure_During = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $Ultrafiltration = null;

    #[ORM\Column]
    private ?int $Glycemia = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Additional_Info = null;

    #[ORM\OneToOne(mappedBy: 'ID_Dialysis', cascade: ['persist', 'remove'])]
    private ?Appointment $appointment = null;

    #[ORM\OneToMany(mappedBy: 'ID_Dialysis', targetEntity: Medicines::class, cascade: ['persist', 'remove'])]
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

    public function getWeightBefore(): ?string
    {
        return $this->Weight_Before;
    }

    public function setWeightBefore(?string $Weight_Before): self
    {
        $this->Weight_Before = $Weight_Before;

        return $this;
    }

    public function getWeightAfter(): ?string
    {
        return $this->Weight_After;
    }

    public function setWeightAfter(?string $Weight_After): self
    {
        $this->Weight_After = $Weight_After;

        return $this;
    }

    public function getBloodPressureBefore(): ?string
    {
        return $this->Blood_Pressure_Before;
    }

    public function setBloodPressureBefore(?string $Blood_Pressure_Before): self
    {
        $this->Blood_Pressure_Before = $Blood_Pressure_Before;

        return $this;
    }

    public function getBloodPressureAfter(): ?string
    {
        return $this->Blood_Pressure_After;
    }

    public function setBloodPressureAfter(?string $Blood_Pressure_After): self
    {
        $this->Blood_Pressure_After = $Blood_Pressure_After;

        return $this;
    }

    public function getPressureDuring(): ?string
    {
        return $this->Pressure_During;
    }

    public function setPressureDuring(?string $Pressure_During): self
    {
        $this->Pressure_During = $Pressure_During;

        return $this;
    }

    public function getUltrafiltration(): ?string
    {
        return $this->Ultrafiltration;
    }

    public function setUltrafiltration(?string $Ultrafiltration): self
    {
        $this->Ultrafiltration = $Ultrafiltration;

        return $this;
    }

    public function getGlycemia(): ?int
    {
        return $this->Glycemia;
    }

    public function setGlycemia(int $Glycemia): self
    {
        $this->Glycemia = $Glycemia;

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

    public function getAppointment(): ?Appointment
    {
        return $this->appointment;
    }

    public function setAppointment(?Appointment $appointment): self
    {
        // unset the owning side of the relation if necessary
        if ($appointment === null && $this->appointment !== null) {
            $this->appointment->setIDDialysis(null);
        }

        // set the owning side of the relation if necessary
        if ($appointment !== null && $appointment->getIDDialysis() !== $this) {
            $appointment->setIDDialysis($this);
        }

        $this->appointment = $appointment;

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
            $medicine->setIDDialysis($this);
        }

        return $this;
    }

    public function removeMedicine(Medicines $medicine): self
    {
        if ($this->medicines->removeElement($medicine)) {
            // set the owning side to null (unless already changed)
            if ($medicine->getIDDialysis() === $this) {
                $medicine->setIDDialysis(null);
            }
        }

        return $this;
    }
}
