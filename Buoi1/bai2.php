<?php

    $students = [
        [
            "name" => "Nguyen Van An",
            "age" => 20,
            "score" => 8.5
        ],
        [
            "name" => "Tran Thi Binh",
            "age" => 21,
            "score" => 6.5
        ],
        [
            "name" => "Le Van Cuong",
            "age" => 19,
            "score" => 4.5
        ],
        [
            "name" => "Pham Thi Dung",
            "age" => 20,
            "score" => 7.5
        ]
    ];

    function calculateAverageScore($students) {
        $totalScore = 0;
        foreach ($students as $student) {
            $totalScore += $student["score"];
        }
        return $totalScore / count($students);
    }

    function getRank($score) {
        if ($score >= 8) {
            return "Giỏi";
        } elseif ($score >= 6.5) {
            return "Khá";
        } elseif ($score >= 5) {
            return "Trung bình";
        } else {
            return "Yếu";
        }
    }

    function displayStudent($student) {
        echo "Tên: " . $student["name"] . "<br>";
        echo "Tuổi: " . $student["age"] . "<br>";
        echo "Điểm: " . $student["score"] . "<br>";
        echo "Xếp loại: " . getRank($student["score"]) . "<br><br>";
        echo "<hr>";
    }

    foreach ($students as $student) {
        displayStudent($student);
    }

    $averageScore = calculateAverageScore($students);
    echo "Điểm TB của tất cả sinh viên: ". $averageScore ."";
?>