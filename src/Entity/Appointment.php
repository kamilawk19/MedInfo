<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $Has_Happened = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $End = null;

    #[ORM\ManyToOne(inversedBy: 'appointments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patitent $ID_Patient = null;

    #[ORM\OneToOne(inversedBy: 'appointment', cascade: ['persist', 'remove'])]
    private ?Dialysis $ID_Dialysis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isHasHappened(): ?bool
    {
        return $this->Has_Happened;
    }

    public function setHasHappened(bool $Has_Happened): self
    {
        $this->Has_Happened = $Has_Happened;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->Start;
    }

    public function setStart(?\DateTimeInterface $Start): self
    {
        $this->Start = $Start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->End;
    }

    public function setEnd(?\DateTimeInterface $End): self
    {
        $this->End = $End;

        return $this;
    }

    public function getIDPatient(): ?Patitent
    {
        return $this->ID_Patient;
    }

    public function setIDPatient(?Patitent $ID_Patient): self
    {
        $this->ID_Patient = $ID_Patient;

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
}
