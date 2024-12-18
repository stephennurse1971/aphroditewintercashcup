<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $emailVerified;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $playingSingles;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $playingDoubles;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $paidAmount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paidTo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $doublesPartner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $paymentDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $freeEntry;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $subsidy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $seedDoubles;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $seedSingles;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
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



    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function isEmailVerified(): ?bool
    {
        return $this->emailVerified;
    }

    public function setEmailVerified(bool $emailVerified): self
    {
        $this->emailVerified = $emailVerified;

        return $this;
    }

    public function isPlayingSingles(): ?bool
    {
        return $this->playingSingles;
    }

    public function setPlayingSingles(?bool $playingSingles): self
    {
        $this->playingSingles = $playingSingles;

        return $this;
    }

    public function isPlayingDoubles(): ?bool
    {
        return $this->playingDoubles;
    }

    public function setPlayingDoubles(?bool $playingDoubles): self
    {
        $this->playingDoubles = $playingDoubles;

        return $this;
    }

    public function getPaidAmount(): ?int
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(?int $paidAmount): self
    {
        $this->paidAmount = $paidAmount;

        return $this;
    }

    public function getPaidTo(): ?string
    {
        return $this->paidTo;
    }

    public function setPaidTo(?string $paidTo): self
    {
        $this->paidTo = $paidTo;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getDoublesPartner(): ?self
    {
        return $this->doublesPartner;
    }

    public function setDoublesPartner(?self $doublesPartner): self
    {
        $this->doublesPartner = $doublesPartner;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(?\DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function isFreeEntry(): ?bool
    {
        return $this->freeEntry;
    }

    public function setFreeEntry(?bool $freeEntry): self
    {
        $this->freeEntry = $freeEntry;

        return $this;
    }

    public function getSubsidy(): ?int
    {
        return $this->subsidy;
    }

    public function setSubsidy(?int $subsidy): self
    {
        $this->subsidy = $subsidy;

        return $this;
    }

    public function getSeedDoubles(): ?int
    {
        return $this->seedDoubles;
    }

    public function setSeedDoubles(?int $seedDoubles): self
    {
        $this->seedDoubles = $seedDoubles;

        return $this;
    }

    public function getSeedSingles(): ?int
    {
        return $this->seedSingles;
    }

    public function setSeedSingles(?int $seedSingles): self
    {
        $this->seedSingles = $seedSingles;

        return $this;
    }


}
