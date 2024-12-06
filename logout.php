<?php
session_start();
session_destroy(); // Hủy session
header("Location: index.php"); // Quay về trang chủ
exit();
?>
