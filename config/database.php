<?php

// Cargar variables de entorno desde .env
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            if (!isset($_ENV[$key])) {
                $_ENV[$key] = $value;
            }
        }
    }
}

// Obtener credenciales desde variables de entorno
$hostDB = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'db';
$nameDB = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'library';
$userDB = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'user';
$pwDB = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? 'passwd123';

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