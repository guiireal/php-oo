<?php

$connection = pg_connect("host=localhost port=5432 dbname=books user=postgres password=150793");

pg_query($connection, "CREATE TABLE famous (id INTEGER, name VARCHAR(50))");

pg_query($connection, "INSERT INTO famous (id, name) VALUES (1, 'John Lennon')");
pg_query($connection, "INSERT INTO famous (id, name) VALUES (2, 'Paul McCartney')");
pg_query($connection, "INSERT INTO famous (id, name) VALUES (3, 'George Harrison')");
pg_query($connection, "INSERT INTO famous (id, name) VALUES (4, 'Ringo Starr')");
pg_query($connection, "INSERT INTO famous (id, name) VALUES (5, 'Pete Best')");

pg_close($connection);

echo "Tabela criada com sucesso!";