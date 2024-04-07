<?php

require_once './FamousRepository.php';

class FamousPDOPostgreSqlRepository implements FamousRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('pgsql:host=localhost;port=5432;dbname=books;user=postgres;password=150793;');
    }

    public function store(Famous $famous): void
    {
        $statement = $this->connection->prepare('INSERT INTO famous (id, name) VALUES (:id, :name)');
        $statement->execute([
            'id' => $famous->getId(),
            'name' => $famous->getName()
        ]);
    }

    public function update(Famous $famous): void
    {
        $statement = $this->connection->prepare('UPDATE famous SET name = :name WHERE id = :id');
        $statement->execute([
            'id' => $famous->getId(),
            'name' => $famous->getName()
        ]);   
    }

    public function destroy(string $id): void
    {
        $statement = $this->connection->prepare('DELETE FROM famous WHERE id = :id');
        $statement->execute(['id' => $id]);
    }

    public function getById(string $id): Famous
    {
        $statement = $this->connection->prepare('SELECT * FROM famous WHERE id = :id');
        $statement->execute(['id' => $id]);
        $famous = $statement->fetch(PDO::FETCH_ASSOC);

        return new Famous($famous['id'], $famous['name']);  
    }

    public function getAll(): array
    {
        $statement = $this->connection->prepare('SELECT * FROM famous');
        $statement->execute();
        $famouses = $statement->fetchAll(PDO::FETCH_ASSOC);

        $famousList = [];
        foreach ($famouses as $famous) {
            $famousList[] = new Famous($famous['id'], $famous['name']);
        }

        return $famousList;   
    }

    public function nextIdentity(): string
    {
        $statement = $this->connection->prepare('SELECT MAX(id) AS last_id FROM famous');
        $statement->execute();

        $id = $statement->fetch(PDO::FETCH_ASSOC);

        return strval(intval($id['last_id']) + 1);
    }
}