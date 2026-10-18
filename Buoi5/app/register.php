<?php
require_once __DIR__ . "/common/dbConnect.php";

$error = "";
$success = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || trim($password) === "") {
        $error = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
    } elseif (strlen($username) > 50) {
        $error = "Tên đăng nhập không được vượt quá 50 ký tự.";
    } else {
        $stmt = $conn->prepare(
            "SELECT id FROM users WHERE username = ?"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Tên đăng nhập đã tồn tại.";
        } else {
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt->close();

            $stmt = $conn->prepare(
                "INSERT INTO users (username, password)
                 VALUES (?, ?)"
            );
            $stmt->bind_param(
                "ss",
                $username,
                $hashedPassword
            );

            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: login.php?registered=1");
                exit;
            } else {
                $error = "Đăng ký thất bại. Vui lòng thử lại.";
            }
        }

        $stmt->close();
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>Đăng ký tài khoản</h2>

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

    <button type="submit">Đăng ký</button>
    <a href="login.php">Đăng nhập</a>
</form>

<?php require_once __DIR__ . "/view/footer.php"; ?>
