<?php

try {
    $conn = new PDO('pgsql:host=localhost;port=5432;dbname=books;user=postgres;password=150793;');

    $conn->exec("INSERT INTO famous (id, name) VALUES (6, 'Érico Veríssimo')");
    $conn->exec("INSERT INTO famous (id, name) VALUES (7, 'John Lennon')");
    $conn->exec("INSERT INTO famous (id, name) VALUES (8, 'Mahatma Gandhi')");
    $conn->exec("INSERT INTO famous (id, name) VALUES (9, 'Ayrton Senna')");
    $conn->exec("INSERT INTO famous (id, name) VALUES (10, 'Charlie Chaplin')");
    $conn->exec("INSERT INTO famous (id, name) VALUES (11, 'Anita Garibaldi')");
    $conn->exec("INSERT INTO famous (id, name) VALUES (12, 'Mário Quintana')");
    
    echo "Registros inseridos com sucesso!";
} catch (PDOException $exception) {
    print "Erro!: " . $exception->getMessage() . "\n";
}