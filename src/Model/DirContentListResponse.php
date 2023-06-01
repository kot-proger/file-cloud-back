<?php

namespace App\Model;

class DirContentListResponse
{
    private int $dirId;

    private string $dirName;

    /**
     * @var DirContentListItem[]
     */
    private array $items;

    /**
     * @return DirContentListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param DirContentListItem[] $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function getDirId(): int
    {
        return $this->dirId;
    }

    public function setDirId(int $dirId): self
    {
        $this->dirId = $dirId;

        return $this;
    }

    public function getDirName(): string
    {
        return $this->dirName;
    }

    public function setDirName(string $dirName): self
    {
        $this->dirName = $dirName;

        return $this;
    }
}
