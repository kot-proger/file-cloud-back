<?php

namespace App\Entity;

use App\Repository\FileRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $path = null;

    #[ORM\Column(type: 'integer')]
    private ?int $size = null;

    #[ORM\Column(type: 'date')]
    private DateTimeInterface $uploadDate;

    //    #[ORM\ManyToMany(targetEntity: User)]

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getUploadDate(): ?DateTimeInterface
    {
        return $this->uploadDate;
    }

    public function setUploadDate(?DateTimeInterface $uploadDate): self
    {
        $this->uploadDate = $uploadDate;

        return $this;
    }
}
