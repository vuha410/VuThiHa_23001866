CREATE DATABASE quanlyvexemphim;

USE quanlyvexemphim;

CREATE TABLE movies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL
);

-- Them 5 phim vao bang
INSERT INTO movies (title, price, total_seats, available_seats) VALUES
('Trại buôn người', 55000, 300, 235),
('Út Lan 2', 70000, 200, 152),
('Lên hương', 70000, 200, 106),
('Tên cậu là gì', 20000, 350, 308),
('Vùng đất quỷ dữ', 70000, 350, 312);


-- Hien thi toan bo phim
SELECT * FROM movies;

-- Hien thi phim co gia lon hon 100000
SELECT *
FROM movies
WHERE price > 100000;

-- Hien thi phim co so luong ghe trong lon hon 50
SELECT *
FROM movies
WHERE available_seats > 50;

-- Sap xep phim  theo gia giam dan
SELECT *
FROM movies
ORDER BY price DESC;

-- Cap nhat so ghe con lai cua mot bo phim
UPDATE movies
SET available_seats= 280
WHERE title = 'Tên cậu là gì';

-- Xoa 1 phim
DELETE FROM movies
WHERE title ='Lên hương';

-- Hien thi so ve ve da ban cua tung phim
SELECT title, (total_seats - available_seats) AS So_ve_da_ban
FROM movies;

-- Tinh doanh thu cua tung phim
SELECT title, (total_seats - available_seats) * price AS Doanh_thu
FROM movies;

-- Tinh tong doanh thu cua toan bo rap
SELECT SUM((total_seats - available_seats) * price) AS Tong_doanh_thu
FROM movies;

-- Tim phim co so ve da ban nhieu nhat
SELECT *
FROM movies
WHERE (total_seats - available_seats) = (
    SELECT MAX(total_seats - available_seats)
    FROM movies
);