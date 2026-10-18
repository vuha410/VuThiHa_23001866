<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "shopping_cart";

mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_errno) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Không thể kết nối đến cơ sở dữ liệu. Vui lòng kiểm tra cấu hình kết nối.");
}

if (!$conn->set_charset("utf8mb4")) {
    error_log("Could not set database connection charset: " . $conn->error);
    die("Không thể thiết lập mã hóa kết nối cơ sở dữ liệu.");
}
