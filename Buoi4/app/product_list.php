<?php

require_once __DIR__ . "/model/product.php";

$products = getAllProducts();

require_once __DIR__ . "/view/header.php";
?>

<h2>Danh sách sản phẩm</h2>

<a href="product_add.php">[Thêm sản phẩm]</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($products)): ?>
            <tr>
                <td colspan="5">Chưa có sản phẩm.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo (int) $product['id']; ?></td>
                    <td><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo number_format((float) $product['price'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo (int) $product['quantity']; ?></td>
                    <td>
                        <a href="product_edit.php?id=<?php echo (int) $product['id']; ?>">[Sửa]</a>
                        |
                        <a
                            href="product_delete.php?id=<?php echo (int) $product['id']; ?>"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');"
                        >[Xóa]</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php require_once __DIR__ . "/view/footer.php"; ?>
