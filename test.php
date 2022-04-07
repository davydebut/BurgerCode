<?php

// EXERCICES JOHN CODEUR

try {
    $database = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$results = $database->query('SELECT * FROM users');

/* $variable = $results->fetchAll(PDO::FETCH_OBJ);

var_dump($variable);

var_dump($results->fetch(PDO::FETCH_ASSOC)); */

while ($row = $results->fetch()) {
    echo $row['name'] . '<br>';
}
