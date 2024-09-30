<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html'); // Redirect to login if not logged in
    exit();
}

include './db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $genre = $_POST['genre'];
    $publication_year = $_POST['publication_year'];

    // Check if the ISBN already exists
    $sql = "SELECT * FROM books WHERE isbn = :isbn";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['isbn' => $isbn]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "ISBN is already registered."]);
    } else {
        // Insert the book data into the database
        $sql = 'INSERT INTO books (title, author, isbn, genre, publication_year) 
                VALUES (:title, :author, :isbn, :genre, :publication_year)';
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([
            'title' => $title,
            'author' => $author,
            'isbn' => $isbn,
            'genre' => $genre,
            'publication_year' => $publication_year
        ])) {
            // Redirect to books.php after successful insertion
            header('Location: books.php');
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->errorInfo()[2]]);
        }
    }
}
?>
