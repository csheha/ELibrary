<?php
include './db.php';  // Ensure this path is correct relative to the location of your file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash the password

    // Check if the email already exists
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "Email is already registered."]);
    } else {
        // Insert user details into the database
        $sql = "INSERT INTO users (fullname, username, email, password) VALUES (:fullname, :username, :email, :password)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([
            'fullname' => $fullname,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ])) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->errorInfo()[2]]);
        }
    }
}
?>
