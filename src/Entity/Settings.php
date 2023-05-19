<?php

namespace App\Entity;

use App\Repository\SettingsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
class Settings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: User::class)]
    private UserInterface $user;

    #[ORM\Column(type: 'boolean')]
    private bool $isAlwaysForAll = false;

    #[ORM\Column(type: 'boolean')]
    private bool $enableNotifications = true;

    public function getId(): ?int
    {
        return $this->id;
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

    public function isAlwaysForAll(): bool
    {
        return $this->isAlwaysForAll;
    }

    public function setIsAlwaysForAll(bool $isAlwaysForAll): self
    {
        $this->isAlwaysForAll = $isAlwaysForAll;

        return $this;
    }

    public function isEnableNotifications(): bool
    {
        return $this->enableNotifications;
    }

    public function setEnableNotifications(bool $enableNotifications): self
    {
        $this->enableNotifications = $enableNotifications;

        return $this;
    }
}
