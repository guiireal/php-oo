<?php

class ProductGateway
{
    private static PDO $connection;

    public static function setConnection(PDO $connection): void
    {
        self::$connection = $connection;
    }

    public function find(int|string $id, $class = 'stdClass')
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = self::$connection->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetchObject($class);
    }

    public function all(?string $filter = null, ?string $class = 'stdClass'): false|array
    {
        $sql = "SELECT * FROM products";

        if ($filter) {
            $sql .= " WHERE {$filter}";
        }

        $stmt = self::$connection->query($sql);

        return $stmt->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function delete(int|string $id): bool
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = self::$connection->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function save(stdClass $product): bool
    {
        if (empty($product->id)) {
            $id = $this->getLastId() + 1;
            $sql = "
                INSERT INTO
                    products (id, description, qty, cost_price, sale_price, bar_code, created_at, origin)
                VALUES (:id, :description, :qty, :cost_price, :sale_price, :bar_code, :created_at, :origin)
            ";
        } else {
            $id = $product->id;
            $sql = "
                UPDATE
                    products
                SET
                    description = :description,
                    qty = :qty,
                    cost_price = :cost_price,
                    sale_price = :sale_price,
                    bar_code = :bar_code,
                    created_at = :created_at,
                    origin = :origin
                WHERE
                    id = :id
            ";
        }

        $stmt = self::$connection->prepare($sql);

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':description', $product->description);
        $stmt->bindValue(':qty', $product->qty);
        $stmt->bindValue(':cost_price', $product->cost_price);
        $stmt->bindValue(':sale_price', $product->sale_price);
        $stmt->bindValue(':bar_code', $product->bar_code);
        $stmt->bindValue(':created_at', date('Y-m-d'));
        $stmt->bindValue(':origin', $product->origin);

        return $stmt->execute();
    }

    public function getLastId(): int
    {
        $sql = "SELECT MAX(id) as max_id FROM products";
        $stmt = self::$connection->query($sql);

        return $stmt->fetch(PDO::FETCH_OBJ)->max_id ?? 0;
    }

}
