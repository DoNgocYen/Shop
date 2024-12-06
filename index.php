<?php
include('includes/db.php'); // Kết nối cơ sở dữ liệu

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecommerce Website</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Welcome to My Shop</h1>
    <nav>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="index.php">Home</a>
        <a href="cart.php">Your Cart</a>
        <?php if ($_SESSION['user_id'] == 1): ?>
          <a href="admin.php">Admin Panel</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="#auth">Login/Register</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <h2>Our Products</h2>
    <div class="product-list">
      <?php while ($product = $result->fetch_assoc()): ?>
        <div class="product-item">
          <img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
          <h3><?php echo $product['name']; ?></h3>
          <p><?php echo $product['description']; ?></p>
          <p>Price: $<?php echo $product['price']; ?></p>
          <a href="add_to_cart.php?product_id=<?php echo $product['id']; ?>">Add to Cart</a>
        </div>
      <?php endwhile; ?>
    </div>
  </main>
</body>
</html>
