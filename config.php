<?php

function connect() {
    $host = '127.0.0.1';
    $dbname = 'aurel';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
    }
}
