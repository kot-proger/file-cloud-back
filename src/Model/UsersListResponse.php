<?php

namespace App\Model;

class UsersListResponse
{
    /**
     * @var UsersListItem[]
     */
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return UsersListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param UsersListItem[] $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
