<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity("email")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 25,
        minMessage: "value 'name' is so short (min: {{ min }})",
        maxMessage: "value 'name' is so long (max: {{ max }})"
    )]
    #[ORM\Column]
    private ?string $name = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 25,
        minMessage: "value 'surname' is so short (min: {{ min }})",
        maxMessage: "value 'surname' is so long (max: {{ max }})"
    )]
    #[ORM\Column]
    private ?string $surname = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[ORM\Column]
    private ?string $email = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 8,
        minMessage: "value 'password' is so short (min: {{ min }})",
    )]
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct($data)
    {
        $this->name = $data['name'] ?? null;
        $this->surname = $data['surname'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->password = password_hash($data['password'], PASSWORD_DEFAULT) ?? null;

        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
