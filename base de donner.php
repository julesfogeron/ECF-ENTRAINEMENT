<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "ecf";

$dsn = "mysql:host=$hostname;dbname=$database";


$conn = new PDO($dsn, $username, $password);

if ($conn) {
    // La connexion est réussie
    echo "oui";
} else {
    echo "non";
    // La connexion a échoué
}

