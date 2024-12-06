<?php
session_start();
include('includes/db.php'); // Kết nối cơ sở dữ liệu

// Kiểm tra nếu người dùng đã đăng nhập là admin (giả sử ID admin là 1)
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    header('Location: index.php'); // Nếu không phải admin, chuyển về trang chủ
    exit();
}

// Xử lý form thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    // Xử lý upload hình ảnh
    $target_dir = "uploads/"; // Thư mục lưu trữ hình ảnh
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Di chuyển hình ảnh đến thư mục uploads

        // Lưu thông tin sản phẩm vào cơ sở dữ liệu
        $sql = "INSERT INTO products (name, description, price, image) 
                VALUES ('$name', '$description', '$price', '$image')";
        if ($conn->query($sql) === TRUE) {
            echo "New product added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
</head>
<body>
  <h1>Admin Panel</h1>
  <a href="index.php">Go to Homepage</a>

  <h2>Add New Product</h2>
  <form action="admin.php" method="POST" enctype="multipart/form-data">
    <label for="name">Product Name</label><br>
    <input type="text" name="name" id="name" required><br>

    <label for="description">Description</label><br>
    <textarea name="description" id="description" required></textarea><br>

    <label for="price">Price</label><br>
    <input type="number" name="price" id="price" required><br>

    <label for="image">Image</label><br>
    <input type="file" name="image" id="image" required><br>

    <button type="submit">Add Product</button>
  </form>
</body>
</html>
