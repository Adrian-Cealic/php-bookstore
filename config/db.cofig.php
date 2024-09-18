<?php

function getDbConnection()
{
    $host = "localhost";
    $dbname = "bookstore";
    $user = "root";
    $paswword = "";

    $dsn = "mysql:host=$host;dbname=$dbname";
    try {
        $pdo = new PDO($dsn, $user, $paswword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
        die();
    }
}