<?php

class Product
{
    private static PDO $connection;
    private array $data;

    public function __get(string $prop)
    {
        return $this->data[$prop];
    }

    public function __set(string $prop, mixed $value)
    {
        $this->data[$prop] = $value;
    }

    public static function setConnection(PDO $connection): void
    {
        self::$connection = $connection;
        ProductGateway::setConnection($connection);
    }

    public static function find(int|string $id)
    {
        $gateway = new ProductGateway;
        return $gateway->find($id, 'Product');
    }

    public static function all($filter = ''): false|array
    {
        $gateway = new ProductGateway;
        return $gateway->all($filter, 'Product');
    }

    public function delete(): bool
    {
        $gateway = new ProductGateway;
        return $gateway->delete($this->id);
    }

    public function save(): bool
    {
        $gateway = new ProductGateway;
        return $gateway->save((object) $this->data);
    }

    public function getProfitMargin(): float|int
    {
        return (($this->sale_price - $this->cost_price) / $this->cost_price) * 100;
    }

    public function purchase(float $cost, int $qty): void
    {
        $this->cost_price = $cost;
        $this->qty += $qty;
    }
}
