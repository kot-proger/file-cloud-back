<?php

namespace App\Model;

class LogListResponse
{
    /**
     * @var LogListItem[]
     */
    private array $items;

    /**
     * @param LogListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return LogListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
