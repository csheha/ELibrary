<?php
// Enable error reporting to help debug any issues
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include your database connection
include 'db.php';  // Assuming you have a db.php file for the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="styles5.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="add-book.html">Add Book</a></li>
            <li><a href="books.php">View Books</a></li>
            <li><a href="deletebook.html">Delete Book</a></li>
            <li><a href="add-to-cart.html">Add to Cart</a></li>
            <li><a href="logout.html">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>List of Available Books</h1>

        <?php
        try {
            // SQL query to fetch all books from the database
            $sql = "SELECT * FROM books";  // Assuming you have a table named 'books'
            $stmt = $pdo->prepare($sql);   // $pdo is your database connection object from db.php
            $stmt->execute();
            $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($books) > 0) {
                // Display books in an HTML table
                echo "<table border='1'>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Genre</th>
                                <th>Publication Year</th>
                            </tr>
                        </thead>
                        <tbody>";
                foreach ($books as $book) {
                    echo "<tr>
                            <td>" . htmlspecialchars($book['title']) . "</td>
                            <td>" . htmlspecialchars($book['author']) . "</td>
                            <td>" . htmlspecialchars($book['isbn']) . "</td>
                            <td>" . htmlspecialchars($book['genre']) . "</td>
                            <td>" . htmlspecialchars($book['publication_year']) . "</td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No books found.</p>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
