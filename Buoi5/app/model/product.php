<?php

require_once __DIR__ . "/../common/dbConnect.php";

function getAllProducts()
{
    global $conn;

    $result = $conn->query("SELECT * FROM products ORDER BY id ASC");
    if (!$result) {
        return [];
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

function getProductById($id)
{
    global $conn;

    $id = (int) $id;
    $statement = $conn->prepare("SELECT * FROM products WHERE id = ?");
    if (!$statement) {
        return null;
    }

    $statement->bind_param("i", $id);
    if (!$statement->execute()) {
        $statement->close();
        return null;
    }

    $result = $statement->get_result();
    $product = $result ? $result->fetch_assoc() : null;
    $statement->close();

    return $product ?: null;
}

function addProduct($name, $price, $quantity)
{
    global $conn;

    $price = (float) $price;
    $quantity = (int) $quantity;
    $statement = $conn->prepare(
        "INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)"
    );
    if (!$statement) {
        return false;
    }

    $statement->bind_param("sdi", $name, $price, $quantity);
    $success = $statement->execute();
    $statement->close();

    return $success;
}

function updateProduct($id, $name, $price, $quantity)
{
    global $conn;

    $id = (int) $id;
    $price = (float) $price;
    $quantity = (int) $quantity;
    $statement = $conn->prepare(
        "UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?"
    );
    if (!$statement) {
        return false;
    }

    $statement->bind_param("sdii", $name, $price, $quantity, $id);
    $success = $statement->execute();
    $statement->close();

    return $success;
}

function deleteProduct($id)
{
    global $conn;

    $id = (int) $id;
    $statement = $conn->prepare("DELETE FROM products WHERE id = ?");
    if (!$statement) {
        return false;
    }

    $statement->bind_param("i", $id);
    $success = $statement->execute();
    $statement->close();

    return $success;
}
