<?php
    $name="Nguyễn Văn A";
    $score= 9;

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