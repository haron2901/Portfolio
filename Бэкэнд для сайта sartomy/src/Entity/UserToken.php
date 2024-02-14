<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Repository\UserTokenRepository;
use DateInterval;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserTokenRepository::class)]
#[UniqueEntity("token")]
class UserToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Assert\NotNull]
    #[Assert\NotBlank]
    #[ORM\Column]
    private ?int $userId = null;


    #[ORM\Column(length: 255)]
    #[Assert\Length(
        exactly: 30
    )]
    private ?string $token = null;

    #[ORM\Column]
    private ?bool $isActive = false;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $activeUntil = null;



    public function __construct($userId = null)
    {
        recreate:
        try {
            $token = bin2hex(random_bytes(15));
        } catch (\Exception $e) {
            goto recreate;
        }
        $this->userId = $userId ?? null;
        $this->token = $token;
        $this->isActive = true;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->activeUntil = $this->createdAt->add(new DateInterval('P30D'));
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool|null $isActive
     */
    public function setIsActive(?bool $isActive): void
    {
        $this->isActive = $isActive;
        $this->updatedAt = new \DateTimeImmutable();
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

    public function getActiveUntil(): ?\DateTimeImmutable
    {
        return $this->activeUntil;
    }

    public function setActiveUntil(\DateTimeImmutable $activeUntil): static
    {
        $this->activeUntil = $activeUntil;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


}
