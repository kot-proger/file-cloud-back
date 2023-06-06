<?php

namespace App\Entity;

use App\Repository\DirectoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: DirectoryRepository::class)]
class Directory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\JoinColumn(nullable: true)]
    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?UserInterface $user = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?self $parentDir = null;

    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    public function getPath(): ?string
    {
        $directory = $this->parentDir;
        $path = '/'.$directory->getName();

        while (null !== $directory) {
            $directory = $directory->getParentDir();
            $path = '/'.$directory->getName().$path;
        }

        return $path;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentDir(): ?self
    {
        return $this->parentDir;
    }

    public function setParentDir(?self $parentDir): self
    {
        $this->parentDir = $parentDir;

        return $this;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(?UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
