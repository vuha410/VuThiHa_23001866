CREATE DATABASE shopping_cart;

USE shopping_cart;

CREATE TABLE cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL
);

-- Them 5 san pham vao bang
INSERT INTO cart_items (name, price, quantity) VALUES
('Mì Hảo Hảo', 5000, 20),
('Bánh tráng trộn', 15000, 2),
('Thùng 24 lon nước ngọt Pepsi không calo vị chanh 320ml', 188000, 1),
('Snack', 8000, 4),
('Kẹo mút', 1000, 10),
('Dầu thực vật Tường An Cooking Oil can 2 lít', 108000, 1);

-- Hien thi toan bo san pham
SELECT * FROM cart_items;

-- Hien thi san pham co gia lon hon 100000
SELECT *
FROM cart_items
WHERE price > 100000;

-- Hien thi san pham co so luong lon hon 5
SELECT *
FROM cart_items
WHERE quantity > 5;

-- Sap xep san pham theo gia giam dan
SELECT *
FROM cart_items
ORDER BY price DESC;

-- Cap nhat gia cua mot san pham
UPDATE cart_items
SET price =10000
WHERE name = 'Snack';

-- Cap nhat so luong cua mot san pham
UPDATE cart_items
SET quantity = 8
WHERE name = 'Kẹo mút';

-- Xoa mot san pham
DELETE FROM cart_items
WHERE name = 'Bánh tráng trộn';

-- Hien thi ten san pham, gia, so luong, thanh tien
SELECT name, price, quantity, (price*quantity) AS Thanh_tien
FROM cart_items;

-- Tinh tong tien cua toan bo gio hang
SELECT SUM(price*quantity) AS Tong_tien
FROM cart_items;




