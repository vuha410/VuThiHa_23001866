
<?php

class Database
{
    private $host = "localhost";
    private $dbname = "db_products";
    private $username = "root";
    private $password = "";

    public function connect()
    {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $conn->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

            return $conn;

        } catch (PDOException $e) {
            http_response_code(500);
            die(json_encode([
                "success" => false,
                "message" => "Không thể kết nối cơ sở dữ liệu"
            ], JSON_UNESCAPED_UNICODE));
        }
    }
}
