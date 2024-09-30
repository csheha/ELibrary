<?php
$host = 'localhost';
$db = 'booknest';
$user = 'booknest';
$pass = '';

try {
    // Connect to MySQL server
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $db");
    // Commented out the echo line that displays database creation message
    // echo "Database '$db' created or already exists.<br>";

    // Select the database
    $pdo->exec("USE $db");

    // Table creation queries
    $tables = [
        'users' => "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100) NOT NULL ,
                fullname VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL
            );
        ",
        'books' => "
            CREATE TABLE IF NOT EXISTS books (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(100) NOT NULL ,
                author VARCHAR(100) NOT NULL,
                isbn VARCHAR(100) NOT NULL UNIQUE,
                publication_year INT(100) NOT NULL,
                genre VARCHAR(255) NOT NULL
            );
        "

    ];

    // Create tables
    foreach ($tables as $table => $sql) {
        $pdo->exec($sql);
        // Commented out the echo line that displays table creation message
        // echo "Table '$table' has been created or already exists.<br>";
    }

   

} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>

