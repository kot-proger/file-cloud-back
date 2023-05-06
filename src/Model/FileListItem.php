<?php

namespace App\Model;

class FileListItem
{
    private int $id;

    private string $name;

    private string $path;

    private int $size;

    private string $date;

    public function __construct(int $id, string $name, string $path, int $size, string $date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->path = $path;
        $this->size = $size;
        $this->date = $date;
    }

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

    public function getDate(): string
    {
        return $this->date;
    }
}
