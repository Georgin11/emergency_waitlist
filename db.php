<?php
function getDbConnection() {
    $host = 'localhost';
    $db = 'hospital';
    $user = 'postgres';  // Replace with your DB username
    $pass = 'yourpassword';  // Replace with your DB password
    $charset = 'utf8';

    $dsn = "pgsql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
?>
