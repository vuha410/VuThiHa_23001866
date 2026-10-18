<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý giỏ hàng</title>
</head>

<body>

<h1>QUẢN LÝ GIỎ HÀNG</h1>

<?php if (isset($_SESSION["user_id"])): ?>
    <p>
        Xin chào,
        <strong>
            <?= htmlspecialchars(
                $_SESSION["username"],
                ENT_QUOTES,
                "UTF-8"
            ) ?>
        </strong>
        |
        <a href="logout.php">Đăng xuất</a>
    </p>
<?php endif; ?>

<hr>