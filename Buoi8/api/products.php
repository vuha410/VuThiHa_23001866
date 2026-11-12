
<?php

header("Content-Type: application/json; charset=UTF-8");

require_once "../config/database.php";

$database = new Database();
$conn = $database->connect();

// Hàm trả về JSON
function response($success, $message = "", $data = null, $status = 200)
{
    http_response_code($status);

    $result = [
        "success" => $success
    ];

    if ($data !== null) {
        $result["data"] = $data;
    }

    if ($message !== "") {
        $result["message"] = $message;
    }

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// Lấy phương thức HTTP
$method = $_SERVER["REQUEST_METHOD"];

// Lấy id từ URL
$id = isset($_GET["id"]) ? filter_var(
    $_GET["id"],
    FILTER_VALIDATE_INT
) : null;

try {

    // GET - LẤY DANH SÁCH SẢN PHẨM
    if ($method === "GET") {

        $sql = "SELECT * FROM products ORDER BY id ASC";
        $stmt = $conn->query($sql);

        $products = $stmt->fetchAll();

        response(true, "", $products);
    }

    // POST - THÊM SẢN PHẨM MỚI
    elseif ($method === "POST") {

        $input = json_decode(file_get_contents("php://input"), true);

        if (!is_array($input)) {
            response(false, "Dữ liệu JSON không hợp lệ", null, 400);
        }

        $name = isset($input["name"]) && is_string($input["name"])
            ? trim($input["name"])
            : "";

        $price = $input["price"] ?? null;
        $stock = $input["stock"] ?? null;

        // Kiểm tra tên
        if ($name === "" || mb_strlen($name) > 100) {
            response(false, "Tên sản phẩm phải từ 1 đến 100 ký tự", null, 400);
        }

        // Kiểm tra giá
        if (filter_var($price, FILTER_VALIDATE_INT) === false || $price <= 0) {
            response(false, "Đơn giá phải là số nguyên lớn hơn 0", null, 400);
        }

        // Kiểm tra tồn kho
        if (filter_var($stock, FILTER_VALIDATE_INT) === false || $stock < 0) {
            response(false, "Số lượng tồn phải là số nguyên không âm", null, 400);
        }

        $sql = "INSERT INTO products (name, price, stock)
                VALUES (:name, :price, :stock)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ":name" => $name,
            ":price" => $price,
            ":stock" => $stock
        ]);

        response(true, "Thêm sản phẩm thành công", [
            "id" => (int)$conn->lastInsertId()
        ], 201);
    }

    // PUT - CẬP NHẬT SẢN PHẨM
    elseif ($method === "PUT") {

        if ($id === null || $id <= 0) {
            response(false, "ID không hợp lệ", null, 400);
        }

        $input = json_decode(file_get_contents("php://input"), true);

        if (!is_array($input)) {
            response(false, "Dữ liệu JSON không hợp lệ", null, 400);
        }

        $name = isset($input["name"]) && is_string($input["name"])
            ? trim($input["name"])
            : "";

        $price = $input["price"] ?? null;
        $stock = $input["stock"] ?? null;

        if ($name === "" || mb_strlen($name) > 100) {
            response(false, "Tên sản phẩm phải từ 1 đến 100 ký tự", null, 400);
        }

        if (filter_var($price, FILTER_VALIDATE_INT) === false || $price <= 0) {
            response(false, "Đơn giá phải là số nguyên lớn hơn 0", null, 400);
        }

        if (filter_var($stock, FILTER_VALIDATE_INT) === false || $stock < 0) {
            response(false, "Số lượng tồn phải là số nguyên không âm", null, 400);
        }

        // Kiểm tra sản phẩm có tồn tại không
        $check = $conn->prepare(
            "SELECT id FROM products WHERE id = :id"
        );

        $check->execute([":id" => $id]);

        if (!$check->fetch()) {
            response(false, "Không tìm thấy sản phẩm", null, 404);
        }

        $sql = "UPDATE products
                SET name = :name,
                    price = :price,
                    stock = :stock
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ":name" => $name,
            ":price" => $price,
            ":stock" => $stock,
            ":id" => $id
        ]);

        response(true, "Cập nhật sản phẩm thành công");
    }

    // DELETE - XÓA SẢN PHẨM
    elseif ($method === "DELETE") {

        if ($id === null || $id <= 0) {
            response(false, "ID không hợp lệ", null, 400);
        }

        // Kiểm tra sản phẩm tồn tại
        $check = $conn->prepare(
            "SELECT id FROM products WHERE id = :id"
        );

        $check->execute([":id" => $id]);

        if (!$check->fetch()) {
            response(false, "Không tìm thấy sản phẩm", null, 404);
        }

        $sql = "DELETE FROM products WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        response(true, "Xóa sản phẩm thành công");
    }

    else {
        response(false, "Phương thức không được hỗ trợ", null, 405);
    }

} catch (PDOException $e) {

    response(false, "Lỗi cơ sở dữ liệu", null, 500);
}
