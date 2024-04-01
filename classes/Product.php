<?php

require_once 'classes\Item.php';

class Product extends Item
{
    #[Override] public function getPrice(): int
    {
        return $this->price;
    }
}