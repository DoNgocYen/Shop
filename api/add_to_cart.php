<?php
session_start();
include('includes/db.php');

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Lấy ID sản phẩm từ URL
$product_id = $_GET['product_id'];
$user_id = $_SESSION['user_id'];
$quantity = 1; // Mặc định số lượng là 1

// Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
$sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Nếu sản phẩm đã có trong giỏ hàng, chỉ cần cập nhật số lượng
    $sql_update = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $conn->query($sql_update);
} else {
    // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
    $sql_insert = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
    $conn->query($sql_insert);
}

header("Location: cart.php"); // Chuyển hướng người dùng đến trang giỏ hàng
exit();
?>
