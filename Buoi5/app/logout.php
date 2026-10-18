
<?php
session_start();

// Xóa toàn bộ dữ liệu session
$_SESSION = [];

// Hủy session hiện tại
session_destroy();

// Quay về trang đăng nhập
header("Location: login.php");
exit;
