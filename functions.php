<?php
// Database connection settings
$db_file = 'elibrary.db';

function connectDB() {
    global $db_file;
    try {
        $conn = new PDO("sqlite:" . $db_file);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Register a new user
function registerUser($username, $password) {
    $conn = connectDB();
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':username' => $username, ':password' => $passwordHash]);
}

// User login check
function loginUser($username, $password) {
    $conn = connectDB();
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['username'] = $username;
        return true;
    }
    return false;
}

// Add a new book
function addBook($title, $author, $genre, $year) {
    $conn = connectDB();
    $sql = "INSERT INTO books (title, author, genre, publication_year) VALUES (:title, :author, :genre, :year)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':title' => $title, ':author' => $author, ':genre' => $genre, ':year' => $year]);
}

// Fetch all books from the database
function fetchBooks() {
    $conn = connectDB();
    $stmt = $conn->query("SELECT * FROM books");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Log out the user
function logoutUser() {
    session_start();
    session_unset();
    session_destroy();
}
