<?php
include('includes/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please login to remove items from the cart.";
    exit;
}

$cart_id = $_GET['cart_id'];

$sql = "DELETE FROM cart WHERE id = $cart_id";

if ($conn->query($sql) === TRUE) {
    echo "Item removed from cart.";
    header("Location: cart.php"); // Quay lại trang giỏ hàng
} else {
    echo "Error: " . $conn->error;
}
?>
