CREATE DATABASE IF NOT EXISTS shopping_cart

USE shopping_cart;

CREATE TABLE cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL
);

-- Them 5 san pham vao bang
INSERT INTO products (name, price, quantity) VALUES
('Mì Hảo Hảo', 5000, 20),
('Bánh tráng trộn', 15000, 2),
('Thùng 24 lon nước ngọt Pepsi không calo vị chanh 320ml', 188000, 1),
('Snack', 8000, 4),
('Kẹo mút', 1000, 10),
('Dầu thực vật Tường An Cooking Oil can 2 lít', 108000, 1);