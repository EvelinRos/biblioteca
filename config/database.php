<?php

$hostDB = 'host.docker.internal';
$nameDB = 'library';
$userDB = 'user';
$pwDB = 'passwd123';

try {

    $dsn = "mysql:host=$hostDB;dbname=$nameDB;charset=utf8";

    $myPDO = new PDO($dsn, $userDB, $pwDB, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

} catch (PDOException $e) {

    die("Error DB: " . $e->getMessage());
}