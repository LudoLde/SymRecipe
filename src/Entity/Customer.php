<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: CustomersRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Assert\Length(min:3, max:40)]
    #[Assert\NotBlank()]
    private ?string $firstName = null;

    #[ORM\Column(length: 40)]
    #[Assert\Length(min:3, max:40)]
    #[Assert\NotBlank()]
    private ?string $lastName = null;

    #[ORM\Column(length: 160)]
    #[Assert\NotBlank()]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive()]
    #[Assert\GreaterThanOrEqual(18)]
    #[Assert\GreaterThanOrEqual(92)]
    private ?int $years = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive()]
    #[Assert\GreaterThanOrEqual(01)]
    #[Assert\GreaterThanOrEqual(95)]
    private ?int $zipCode = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getYears(): ?int
    {
        return $this->years;
    }

    public function setYears(?int $years): static
    {
        $this->years = $years;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(?int $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
