
<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: product_list.php");
    exit;
}

require_once __DIR__ . "/common/dbConnect.php";

$error = "";
$username = "";

if (isset($_GET["registered"])) {
    $success = "Đăng ký thành công. Vui lòng đăng nhập.";
} else {
    $success = "";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $error = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
    } else {
        $stmt = $conn->prepare(
            "SELECT id, username, password
             FROM users WHERE username = ?"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user["password"])) {
            session_regenerate_id(true);

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];

            $conn->close();

            header("Location: product_list.php");
            exit;
        } else {
            $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
        }
    }
}

$conn->close();
require_once __DIR__ . "/view/header.php";
?>

<h2>Đăng nhập</h2>

<?php if ($success !== ""): ?>
    <p style="color: green;">
        <?= htmlspecialchars($success, ENT_QUOTES, "UTF-8") ?>
    </p>
<?php endif; ?>

<?php if ($error !== ""): ?>
    <p style="color: red;">
        <?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?>
    </p>
<?php endif; ?>

<form method="POST" action="">
    <p>
        <label for="username">Tên đăng nhập:</label><br>
        <input
            type="text"
            id="username"
            name="username"
            maxlength="50"
            value="<?= htmlspecialchars($username, ENT_QUOTES, "UTF-8") ?>"
            required
        >
    </p>

    <p>
        <label for="password">Mật khẩu:</label><br>
        <input
            type="password"
            id="password"
            name="password"
            required
        >
    </p>

    <button type="submit">Đăng nhập</button>
    <a href="register.php">Đăng ký tài khoản</a>
</form>

<?php require_once __DIR__ . "/view/footer.php"; ?>
