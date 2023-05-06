<?php

namespace App\Model;

class FileListResponse
{
    /**
     * @var FileListItem[]
     */
    private array $items;

    /**
     * @param FileListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return FileListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
