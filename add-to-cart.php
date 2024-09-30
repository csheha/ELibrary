<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $bookId = htmlspecialchars($_POST['bookId']);
    $bookTitle = htmlspecialchars($_POST['bookTitle']);
    $quantity = intval($_POST['quantity']);

    // Create a cart item
    $cartItem = [
        'bookId' => $bookId,
        'bookTitle' => $bookTitle,
        'quantity' => $quantity
    ];

    // If the cart doesn't exist in the session, create it
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the item to the cart session
    $_SESSION['cart'][] = $cartItem;

    // Redirect or show a success message
    echo "Book successfully added to cart!";
} else {
    // Handle the case where the form is not submitted via POST
    echo "Invalid request.";
}
