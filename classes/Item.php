<?php

require_once 'interfaces/ICalculable.php';

abstract class Item implements ICalculable
{
    protected string $name;
    protected int $price;

    public function __construct(string $name, int $price)
    {
        $this->name = $name;
        $this->price = ($price > 0) ? $price : 0;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
