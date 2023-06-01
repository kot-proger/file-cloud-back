<?php

namespace App\Model;

class FileAccessListResponse
{
    /**
     * @var FileAccessListItem[]
     */
    private array $items;

    /**
     * @param FileAccessListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return FileAccessListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param FileAccessListItem[] $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
