<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Last_Password_Change = null;

    #[ORM\Column(length: 15)]
    private ?string $First_Name = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $Second_Name = null;

    #[ORM\Column(length: 20)]
    private ?string $Last_Name = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Address $ID_Address = null;

    #[ORM\OneToMany(mappedBy: 'ID_Controller', targetEntity: LastPharmacySupplyCheck::class)]
    private Collection $lastPharmacySupplyChecks;

    #[ORM\Column(length: 8)]
    private ?string $Licensure_Number = null;

    public function __construct()
    {
        $this->lastPharmacySupplyChecks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastPasswordChange(): ?\DateTimeInterface
    {
        return $this->Last_Password_Change;
    }

    public function setLastPasswordChange(\DateTimeInterface $Last_Password_Change): self
    {
        $this->Last_Password_Change = $Last_Password_Change;

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

    public function setSecondName(string $Second_Name): self
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

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

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
     * @return Collection<int, LastPharmacySupplyCheck>
     */
    public function getLastPharmacySupplyChecks(): Collection
    {
        return $this->lastPharmacySupplyChecks;
    }

    public function addLastPharmacySupplyCheck(LastPharmacySupplyCheck $lastPharmacySupplyCheck): self
    {
        if (!$this->lastPharmacySupplyChecks->contains($lastPharmacySupplyCheck)) {
            $this->lastPharmacySupplyChecks->add($lastPharmacySupplyCheck);
            $lastPharmacySupplyCheck->setIDController($this);
        }

        return $this;
    }

    public function removeLastPharmacySupplyCheck(LastPharmacySupplyCheck $lastPharmacySupplyCheck): self
    {
        if ($this->lastPharmacySupplyChecks->removeElement($lastPharmacySupplyCheck)) {
            // set the owning side to null (unless already changed)
            if ($lastPharmacySupplyCheck->getIDController() === $this) {
                $lastPharmacySupplyCheck->setIDController(null);
            }
        }

        return $this;
    }

    public function getLicensureNumber(): ?string
    {
        return $this->Licensure_Number;
    }

    public function setLicensureNumber(string $Licensure_Number): self
    {
        $this->Licensure_Number = $Licensure_Number;

        return $this;
    }
}
