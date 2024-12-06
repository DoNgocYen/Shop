<?php
session_start();
include('includes/db.php');

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Lấy giỏ hàng của người dùng
$user_id = $_SESSION['user_id'];
$sql = "SELECT cart.id, products.name, products.price, cart.quantity 
        FROM cart 
        JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart</title>
</head>
<body>
  <h1>Your Cart</h1>
  <a href="index.php">Continue Shopping</a>
  <a href="logout.php">Logout</a>

  <table>
    <tr>
      <th>Product Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total</th>
    </tr>
    <?php
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $total += $row['price'] * $row['quantity'];
        echo "<tr>
                <td>{$row['name']}</td>
                <td>\${$row['price']}</td>
                <td>{$row['quantity']}</td>
                <td>\$" . $row['price'] * $row['quantity'] . "</td>
              </tr>";
    }
    ?>
  </table>
  <h3>Total: $<?php echo $total; ?></h3>
  <button>Proceed to Checkout</button>
</body>
</html>
