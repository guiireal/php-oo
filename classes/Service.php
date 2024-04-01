<?php

require_once 'classes\Item.php';

class Service extends Item
{
    #[Override] public function getPrice(): int
    {
        return $this->price;
    }
}