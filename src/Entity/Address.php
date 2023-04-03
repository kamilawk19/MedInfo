<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 90)]
    private ?string $Country = null;

    #[ORM\Column(length: 20)]
    private ?string $Voivodeship = null;

    #[ORM\Column(length: 30)]
    private ?string $City = null;

    #[ORM\Column(length: 10)]
    private ?string $ZIP_Code = null;

    #[ORM\Column(length: 60)]
    private ?string $Street = null;

    #[ORM\Column(length: 4)]
    private ?string $Building_Number = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $Apartment_Number = null;

    #[ORM\OneToMany(mappedBy: 'ID_Address', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'ID_Address', targetEntity: Patitent::class)]
    private Collection $patitents;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->patitents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }

    public function getVoivodeship(): ?string
    {
        return $this->Voivodeship;
    }

    public function setVoivodeship(string $Voivodeship): self
    {
        $this->Voivodeship = $Voivodeship;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getZIPCode(): ?string
    {
        return $this->ZIP_Code;
    }

    public function setZIPCode(string $ZIP_Code): self
    {
        $this->ZIP_Code = $ZIP_Code;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->Street;
    }

    public function setStreet(string $Street): self
    {
        $this->Street = $Street;

        return $this;
    }

    public function getBuildingNumber(): ?string
    {
        return $this->Building_Number;
    }

    public function setBuildingNumber(string $Building_Number): self
    {
        $this->Building_Number = $Building_Number;

        return $this;
    }

    public function getApartmentNumber(): ?string
    {
        return $this->Apartment_Number;
    }

    public function setApartmentNumber(?string $Apartment_Number): self
    {
        $this->Apartment_Number = $Apartment_Number;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setIDAddress($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getIDAddress() === $this) {
                $user->setIDAddress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Patitent>
     */
    public function getPatitents(): Collection
    {
        return $this->patitents;
    }

    public function addPatitent(Patitent $patitent): self
    {
        if (!$this->patitents->contains($patitent)) {
            $this->patitents->add($patitent);
            $patitent->setIDAddress($this);
        }

        return $this;
    }

    public function removePatitent(Patitent $patitent): self
    {
        if ($this->patitents->removeElement($patitent)) {
            // set the owning side to null (unless already changed)
            if ($patitent->getIDAddress() === $this) {
                $patitent->setIDAddress(null);
            }
        }

        return $this;
    }
}
