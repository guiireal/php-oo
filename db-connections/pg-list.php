<?php

$conn = pg_connect("host=localhost port=5432 dbname=books user=postgres password=150793");

$query = 'SELECT id, name FROM famous';

$result = pg_query($conn, $query);

if ($result) {
    while ($row = pg_fetch_assoc($result)) {
        echo $row['id'] . ' - ' . $row['name'] . "<br>\n";
    }
}

pg_close($conn);
