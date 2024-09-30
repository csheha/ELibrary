<?php
include 'db.php';

// Create the books table
$sql = "CREATE TABLE IF NOT EXISTS books (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    author TEXT NOT NULL,
    genre TEXT NOT NULL,
    publication_year INTEGER NOT NULL
)";

try {
    $pdo->exec($sql);
    echo "Table 'books' created successfully.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>
