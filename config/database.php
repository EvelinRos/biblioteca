<?php

$hostDB = 'db';
$nameDB = 'library';
$userDB = 'user';
$pwDB = 'passwd123';

try {

    $dsn = "mysql:host=$hostDB;dbname=$nameDB;charset=utf8mb4";

    $myPDO = new PDO($dsn, $userDB, $pwDB, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

} catch (PDOException $e) {

    die("Error de conexión a la base de datos");
}