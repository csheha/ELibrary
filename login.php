<?php
session_start();
include 'db.php';  // Make sure this file contains the connection to your database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];  // Email field from the form
    $password = $_POST['password'];  // Password field from the form

    // Query to select the user from the database
    $sql = 'SELECT * FROM users WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify if the user exists and password matches
    if ($member && password_verify($password, $member['password'])) {
        $_SESSION['user_id'] = $member['id'];  // Store user ID in session
        $_SESSION['user_name'] = $member['name'];  // Store username in session
        header('Location: index.html');  // Redirect to homepage or dashboard
        exit();
    } else {
        echo 'Invalid email or password.';
    }
}
?>

