<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function pdo(): PDO
{
    static $pdo;

    if (isset($pdo)) {
        return $pdo;
    }

    $pdo = new PDO(
        "mysql:host={$_ENV['HOST']};dbname={$_ENV['MYSQL_DATABASE']}",
        $_ENV['MYSQL_USER'],
        $_ENV['MYSQL_PASSWORD']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
}
