<?php
// Database connection settings
$host = 'localhost';
$db = 'booknest';
$user = 'booknest';
$pass = ''; // Ensure this is the correct password

// Connect to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debugging: Check if 'id' is set and not empty
    if (isset($_POST['id'])) {
        $bookID = $_POST['id'];

        // Prepare the SQL query to delete the book
        $sql = "DELETE FROM books WHERE id = ?";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $bookID); // "i" specifies the type (integer)

        // Execute the query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                // Return success message as a JavaScript alert
                echo "<script>alert('Book with ID $bookID was successfully deleted.');</script>";
                header('Location: books.php');
            } else {
                // Return error message as a JavaScript alert
                echo "<script>alert('No book found with ID $bookID.');</script>";
            }
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Book ID is required.');</script>";
    }
}

// Close the connection
$conn->close();
?>
