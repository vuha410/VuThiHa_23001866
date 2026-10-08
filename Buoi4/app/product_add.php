<?php

require_once __DIR__ . "/model/product.php";

$error = "";
$name = "";
$price = "";
$quantity = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $quantity = trim($_POST["quantity"] ?? "");

    if ($name === "") {
        $error = "Tên sản phẩm không được để trống.";
    } elseif (!is_numeric($price) || (float) $price <= 0) {
        $error = "Giá phải lớn hơn 0.";
    } elseif (!filter_var($quantity, FILTER_VALIDATE_INT) || (int) $quantity < 0) {
        $error = "Số lượng phải là số nguyên lớn hơn hoặc bằng 0.";
    } elseif (addProduct($name, $price, $quantity)) {
        header("Location: product_list.php");
        exit;
    } else {
        $error = "Thêm sản phẩm thất bại.";
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>Thêm sản phẩm</h2>

<?php if ($error !== ""): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8"); ?></p>
<?php endif; ?>

<form method="POST" action="">
    <p>
        <label for="name">Tên sản phẩm:</label><br>
        <input
            type="text"
            id="name"
            name="name"
            value="<?php echo htmlspecialchars($name, ENT_QUOTES, "UTF-8"); ?>"
            required
        >
    </p>

    <p>
        <label for="price">Giá:</label><br>
        <input
            type="number"
            id="price"
            name="price"
            min="0.01"
            step="0.01"
            value="<?php echo htmlspecialchars($price, ENT_QUOTES, "UTF-8"); ?>"
            required
        >
    </p>

    <p>
        <label for="quantity">Số lượng:</label><br>
        <input
            type="number"
            id="quantity"
            name="quantity"
            min="0"
            step="1"
            value="<?php echo htmlspecialchars($quantity, ENT_QUOTES, "UTF-8"); ?>"
            required
        >
    </p>

    <button type="submit">Thêm sản phẩm</button>
    <a href="product_list.php">Quay lại</a>
</form>

<?php require_once __DIR__ . "/view/footer.php"; ?>
