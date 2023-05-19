<?php

namespace App\Entity;

use App\Repository\AccessTokenRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: AccessTokenRepository::class)]
class AccessToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: User::class)]
    private UserInterface $user;
    #[ORM\Column(type: 'text')]
    private ?string $token = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeInterface $created;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeInterface $valid;

    #[ORM\PrePersist]
    public function setCreatedValue(): void
    {
        $this->created = new \DateTimeImmutable();

        $this->valid = new \DateTimeImmutable('+10 days');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getCreated(): \DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getValid(): \DateTimeInterface
    {
        return $this->valid;
    }

    public function setValid(\DateTimeInterface $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }
}
