<?php

namespace App\Model;

class FileListItem
{
    private int $id;

    private string $name;

    private string $path;

    private int $size;

    private int $uploadDate;

    private string $username;

    //    public function __construct(int $id, string $name, string $path, int $size, int $uploadDate)
    //    {
    //        $this->id = $id;
    //        $this->name = $name;
    //        $this->path = $path;
    //        $this->size = $size;
    //        $this->uploadDate = $uploadDate;
    //    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getUploadDate(): int
    {
        return $this->uploadDate;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function setUploadDate(int $uploadDate): self
    {
        $this->uploadDate = $uploadDate;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
