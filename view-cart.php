<?php
session_start();

// Check if the cart exists in the session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Return the cart items as a JSON response
    echo json_encode($_SESSION['cart']);
} else {
    // Return an empty array if the cart is empty
    echo json_encode([]);
}
?>
