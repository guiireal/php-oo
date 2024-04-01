<?php

require_once 'classes\Item.php';

class Cart
{
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addItem(Item $item): void
    {
        $this->items[] = $item;
    }

    public function getTotal(): int
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }

        return $total;
    }
}