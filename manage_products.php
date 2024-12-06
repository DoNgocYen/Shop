<?php
include('includes/db.php');

// Thêm sản phẩm mới
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $sql = "INSERT INTO products (name, price) VALUES ('$name', $price)";
    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Hiển thị danh sách sản phẩm
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

echo "<h2>Manage Products</h2>";

echo "<form action='' method='POST'>";
echo "<input type='text' name='name' placeholder='Product Name' required>";
echo "<input type='number' step='0.01' name='price' placeholder='Product Price' required>";
echo "<button type='submit'>Add Product</button>";
echo "</form>";

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Name</th><th>Price</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>$" . $row['price'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}
?>
