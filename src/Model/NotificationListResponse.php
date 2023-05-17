<?php

namespace App\Model;

class NotificationListResponse
{
    /**
     * @var NotificationListItem[]
     */
    private array $items;

    /**
     * @param NotificationListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return NotificationListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
