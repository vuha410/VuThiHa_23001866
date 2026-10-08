<?php

require_once __DIR__ . "/model/product.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$id = $id !== false && $id !== null ? $id : 0;
$product = getProductById($id);
$message = "";
$deleted = false;

if ($product && $_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["confirm"] ?? "") === "yes") {
    if (deleteProduct($id)) {
        $message = "Đã xóa sản phẩm thành công.";
        $deleted = true;
    } else {
        $message = "Xóa sản phẩm thất bại. Vui lòng thử lại.";
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>Xóa sản phẩm</h2>

<?php if (!$product): ?>
    <p>Sản phẩm không tồn tại.</p>
    <a href="product_list.php">Quay lại danh sách</a>
<?php elseif ($message !== ""): ?>
    <p><?php echo htmlspecialchars($message, ENT_QUOTES, "UTF-8"); ?></p>
    <a href="product_list.php">Quay lại danh sách</a>
<?php else: ?>
    <p>
        Bạn có chắc chắn muốn xóa sản phẩm
        <strong><?php echo htmlspecialchars($product["name"], ENT_QUOTES, "UTF-8"); ?></strong>?
    </p>

    <form method="POST" action="">
        <input type="hidden" name="confirm" value="yes">
        <button type="submit">Xác nhận xóa</button>
        <a href="product_list.php">Hủy</a>
    </form>
<?php endif; ?>

<?php require_once __DIR__ . "/view/footer.php"; ?>
