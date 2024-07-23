<?php
include __DIR__ . "config.php";
use PDO;

try {

    // Create the database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo = new PDO("mysql:host=" . HOST, USER, PASS);
    $pdo->exec("DROP DATABASE IF EXISTS $dbname");
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    // Connect to the database
    $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . NAME, USER, PASS);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the products table
    $sql = "CREATE TABLE IF NOT EXISTS `products` (
        `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `sku` VARCHAR(255) NOT NULL UNIQUE,
        `price` DECIMAL(10,2) NOT NULL,
        `attribute` VARCHAR(255) NOT NULL
    )";
    $pdo->exec($sql);
    echo "Tables created and data inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
// Close the database connection
$pdo = null;
