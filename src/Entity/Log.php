<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: LogRepository::class)]
class Log
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: User::class)]
    private UserInterface $user;

    #[ORM\JoinColumn(nullable: false)]
    #[Orm\ManyToOne(targetEntity: File::class)]
    private File $file;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: LogOperation::class)]
    private LogOperation $logOperation;

    #[ORM\Column(type: 'date_immutable')]
    private \DateTimeInterface $date;

    #[ORM\PrePersist]
    public function setCreatedValue(): void
    {
        $this->date = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function setFile(File $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getLogOperation(): LogOperation
    {
        return $this->logOperation;
    }

    public function setLogOperation(LogOperation $logOperation): self
    {
        $this->logOperation = $logOperation;

        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
