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

    function findBestStudent($students) {
        $bestStudent = null;
        foreach ($students as $student) {
            if ($bestStudent === null || $student["score"] > $bestStudent["score"]) {
                $bestStudent = $student;
            }
        }
        return $bestStudent;
    }

    function findWorstStudent($students) {
        $worstStudent = null;
        foreach ($students as $student) {
            if ($worstStudent === null || $student["score"] < $worstStudent["score"]) {
                $worstStudent = $student;
            }
        }
        return $worstStudent;
    }

    function countPassedStudents($students) {
        $count = 0;
        foreach ($students as $student) {
            if ($student["score"] >= 5) {
                $count++;
            }
        }
        return $count;
    }

    function findStudentByName($students, $name) {
        foreach ($students as $student) {
            if ($student["name"] === $name) {
                return $student;
            }
        }
        return null;
    }

    // Sinh viên có điểm cao nhất 
    $bestStudent = findBestStudent($students); 
    echo "<h3>Sinh viên có điểm cao nhất</h3>"; 
    echo "Họ tên: " . $bestStudent["name"] . "<br>"; 
    echo "Tuổi: " . $bestStudent["age"] . "<br>"; 
    echo "Điểm: " . $bestStudent["score"] . "<br>"; 
    
    // Sinh viên có điểm thấp nhất 
    $worstStudent = findWorstStudent($students); 
    echo "<h3>Sinh viên có điểm thấp nhất</h3>"; 
    echo "Họ tên: " . $worstStudent["name"] . "<br>"; 
    echo "Tuổi: " . $worstStudent["age"] . "<br>"; 
    echo "Điểm: " . $worstStudent["score"] . "<br>"; 
    
    // Số sinh viên đạt 
    $passedStudents = countPassedStudents($students); 
    echo "<h3>Số sinh viên đạt</h3>"; 
    echo "Có " . $passedStudents . " sinh viên đạt.<br>"; 
    
    // Tìm sinh viên theo tên 
    $name = "Vu Thi Ha"; 
    $student = findStudentByName($students, $name); 
    echo "<h3>Tìm sinh viên theo tên: " . $name . "</h3>"; 
    if ($student != null) { 
        echo "Họ tên: " . $student["name"] . "<br>"; 
        echo "Tuổi: " . $student["age"] . "<br>"; 
        echo "Điểm: " . $student["score"] . "<br>"; 
    } else { 
        echo "Không tìm thấy sinh viên."; 
    }
?>