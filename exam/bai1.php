<?php
    $name="Vũ Thị Hà";
    $score= 10;

    if (!is_numeric($score) || $score < 0 || $score > 10) {
        echo "Điểm số không hợp lệ.";
        exit;
    }

    if ($score >= 8) {
        $rank= "Giỏi";
    } elseif ($score >= 6.5 & $score < 8) {
        $rank ="Khá";
    } elseif ($score >= 5 & $score < 6.5) {
        $rank ="Trung bình";
    } else {
        $rank ="Yếu";
    }

    echo "Tên: $name <br> <hr>";
    echo "Điểm số: $score <br> <hr>";
    echo "Xếp loại: $rank <br> <hr>"
?>