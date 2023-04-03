<?php

namespace App\Entity;

use App\Repository\PatitentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatitentRepository::class)]
class Patitent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 11, nullable: true)]
    private ?string $PESEL = null;

    #[ORM\Column(length: 11, nullable: true)]
    private ?string $Document_Number = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $Document_Name = null;

    #[ORM\Column(length: 12)]
    private ?string $First_Name = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $Second_Name = null;

    #[ORM\Column(length: 25)]
    private ?string $Last_Name = null;

    #[ORM\Column(length: 1)]
    private ?string $Sex = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $Dialing_Code = null;

    #[ORM\Column(length: 9)]
    private ?string $Phone_Number = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $Contact_Dialing_Code = null;

    #[ORM\Column(length: 9)]
    private ?string $Contact_Phone_Number = null;

    #[ORM\ManyToOne(inversedBy: 'patitents')]
    private ?Address $ID_Address = null;

    #[ORM\OneToMany(mappedBy: 'ID_Patient', targetEntity: Appointment::class)]
    private Collection $appointments;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Additional_info = null;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPESEL(): ?string
    {
        return $this->PESEL;
    }

    public function setPESEL(?string $PESEL): self
    {
        $this->PESEL = $PESEL;

        return $this;
    }

    public function getDocumentNumber(): ?string
    {
        return $this->Document_Number;
    }

    public function setDocumentNumber(?string $Document_Number): self
    {
        $this->Document_Number = $Document_Number;

        return $this;
    }

    public function getDocumentName(): ?string
    {
        return $this->Document_Name;
    }

    public function setDocumentName(?string $Document_Name): self
    {
        $this->Document_Name = $Document_Name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->First_Name;
    }

    public function setFirstName(string $First_Name): self
    {
        $this->First_Name = $First_Name;

        return $this;
    }

    public function getSecondName(): ?string
    {
        return $this->Second_Name;
    }

    public function setSecondName(?string $Second_Name): self
    {
        $this->Second_Name = $Second_Name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->Last_Name;
    }

    public function setLastName(string $Last_Name): self
    {
        $this->Last_Name = $Last_Name;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->Sex;
    }

    public function setSex(string $Sex): self
    {
        $this->Sex = $Sex;

        return $this;
    }

    public function getDialingCode(): ?string
    {
        return $this->Dialing_Code;
    }

    public function setDialingCode(?string $Dialing_Code): self
    {
        $this->Dialing_Code = $Dialing_Code;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->Phone_Number;
    }

    public function setPhoneNumber(string $Phone_Number): self
    {
        $this->Phone_Number = $Phone_Number;

        return $this;
    }

    public function getContactDialingCode(): ?string
    {
        return $this->Contact_Dialing_Code;
    }

    public function setContactDialingCode(?string $Contact_Dialing_Code): self
    {
        $this->Contact_Dialing_Code = $Contact_Dialing_Code;

        return $this;
    }

    public function getContactPhoneNumber(): ?string
    {
        return $this->Contact_Phone_Number;
    }

    public function setContactPhoneNumber(string $Contact_Phone_Number): self
    {
        $this->Contact_Phone_Number = $Contact_Phone_Number;

        return $this;
    }

    public function getIDAddress(): ?Address
    {
        return $this->ID_Address;
    }

    public function setIDAddress(?Address $ID_Address): self
    {
        $this->ID_Address = $ID_Address;

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments->add($appointment);
            $appointment->setIDPatient($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getIDPatient() === $this) {
                $appointment->setIDPatient(null);
            }
        }

        return $this;
    }

    public function getAdditionalInfo(): ?string
    {
        return $this->Additional_info;
    }

    public function setAdditionalInfo(?string $Additional_info): self
    {
        $this->Additional_info = $Additional_info;

        return $this;
    }
}
