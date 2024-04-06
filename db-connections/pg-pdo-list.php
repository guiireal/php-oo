<?php

try {
    $conn = new PDO('pgsql:host=localhost;port=5432;dbname=books;user=postgres;password=150793;');

    $result = $conn->query("SELECT id, name FROM famous");

    if ($result) {
        echo "Exibindo como um iterável: <br>\n";

    
        foreach($result as $row) {
            echo $row['id'] . ' - ' . $row['name'] . "<br>\n";
        }

        echo "<br>\nExibindo como objetos: <br>\n";

        $result = $conn->query("SELECT id, name FROM famous");

        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            echo $row->id . ' - '. $row->name . "<br>\n";
        }
    }

    $conn = null;
} catch (PDOException $exception) {
    print "Erro!: " . $exception->getMessage() . "\n";
}