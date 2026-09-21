<?php
    class Student {
        public $name;
        public $age;
        public $score;
        
        public function __construct($name, $age, $score) {
            $this->name = $name;
            $this->age = $age;
            $this->score = $score;
        }

        public function getRank() {
            if ($this->score >= 8) {
                return "Giỏi";
            } elseif ($this->score >= 6.5) {
                return "Khá";
            } elseif ($this->score >= 5) {
                return "Trung bình";
            } else {
                return "Yếu";
            }
        }

        public function isPassed() {
            return $this->score >= 5;
        }

        public function display() {
            echo "Tên: " . $this->name . "<br>";
            echo "Tuổi: " . $this->age . "<br>";
            echo "Điểm: " . $this->score . "<br>";
            echo "Xếp loại: " . $this->getRank() . "<br><br>";
            if ($this->isPassed()) {
                echo "Đạt.<br>";
            } else {
                echo "Chưa đạt.<br>";
            }
            echo "<hr>";
        }
    }

    $student1 = new Student("Nguyen Van An", 20, 8.5); 
    $student2 = new Student("Tran Thi Binh", 21, 6.5); 
    $student3 = new Student("Le Van Cuong", 19, 4.5); 
    $student4 = new Student("Pham Thi Dung", 20, 7.5);

    $students = [$student1, $student2, $student3, $student4];

    function findBestStudent($students) {
        $bestStudent = $students[0];
        foreach ($students as $student) {
            if ($student->score > $bestStudent->score) {
                $bestStudent = $student;
            }
        }
        return $bestStudent;
    }

    function countPassedStudents($students) {
        $count = 0;
        foreach ($students as $student) {
            if ($student->isPassed()) {
                $count++;
            }
        }
        return $count;
    }

    function calculateAverageScore($students) {
        $totalScore = 0;
        foreach ($students as $student) {
            $totalScore += $student->score;
        }
        return $totalScore / count($students);
    }

    echo "<h2>Danh sách sinh viên</h2>"; 
    
    // Hiển thị danh sách sinh viên 
    foreach ($students as $student) { 
        $student->display(); 
    } 
    
    // Tìm sinh viên có điểm cao nhất 
    $bestStudent = findBestStudent($students); 
    echo "<h2>Sinh viên có điểm cao nhất</h2>"; 
    echo "Họ tên: " . $bestStudent->name . "<br>"; 
    echo "Điểm: " . $bestStudent->score . "<br>"; 
    
    // Đếm số sinh viên đạt 
    $passedCount = countPassedStudents($students); 
    echo "<h2>Số sinh viên đạt</h2>"; 
    echo "Có " . $passedCount . " sinh viên đạt.<br>"; 
    
    // Tính điểm trung bình 
    $averageScore = calculateAverageScore($students); 
    echo "<h2>Điểm trung bình của lớp</h2>"; 
    echo $averageScore;
?>