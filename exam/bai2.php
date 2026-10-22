<?php
    $prices = [100000, 200000, 150000, 300000, 250000];

    if (empty($prices)) {
        echo "Giá trị sản phẩm không có.";
    } else {
        echo "Danh sách giá trị sản phẩm: <br>";
        foreach ($prices as $price) {
            echo $price . "<br>";
        }
    }

    function calculateTotal($prices) {
        $total = 0;
        foreach ($prices as $price) {
            $total += $price;
        }
        return $total;
    }

    function findMaxPrice($prices) {
        return max($prices);
    }

    $total = calculateTotal($prices);
    $maxPrice = findMaxPrice($prices);

    echo "Tổng giá trị sản phẩm: " . $total . "<br><hr>";
    echo " Giá trị sản phẩm cao nhất: " . $maxPrice . "<br><hr>";
?>