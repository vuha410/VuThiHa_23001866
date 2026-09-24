<?php
    class Movie{
        public $id;
        public $title;
        public $price;
        public $totalSeats;
        public $availableSeats;

        public function __construct($id, $title, $price, $totalSeats) {
            $this->id = $id;
            $this->title = $title;
            $this->price = $price;
            $this->totalSeats = $totalSeats;
            $this->availableSeats = $totalSeats;
        }

        public function bookTicket($quantity){
            if ($quantity <= 0){
                echo "Số lượng vé phải lớn hơn 0."."<br>";
                return;
            }

            if ($quantity > $this->availableSeats){
                echo "Không thể đặt {$quantity} vé cho phim "
                . "'{$this->title}': chỉ còn "
                . "{$this->availableSeats} ghế.<br>";
            return false;
            }

            $this->availableSeats -= $quantity;
            echo "Đặt {$quantity} vé cho phim '{$this->title}' thành công.<br>";
            return true;
        }

        public function cancelTicket($quantity){
            if ($quantity <= 0){
                echo "Số lượng vé phải lớn hơn 0."."<br>";
                return;
            }

            $soldSeats=$this->getSoldSeats();

            if ($soldSeats < $quantity){
                echo "Không thể hủy {$quantity} vé phim "
                . "'{$this->title}': chỉ có "
                . "{$soldSeats} vé đã bán.<br>";
            return false;
            }

            $this->availableSeats += $quantity;
            echo "Đã hủy {$quantity} vé cho phim '{$this->title}'.<br>";
            return true;
        }

        public function getSoldSeats(){
            return $this->totalSeats - $this->availableSeats;
        }

        public function getRevenue(){
            return $this->getSoldSeats() * $this->price;
        }

        public function displayInfo(){
            echo "<table border='1' cellpadding='8' cellspacing='0'>";

            echo "<tr>";
            echo "<th>Mã phim</th>";
            echo "<td>{$this->id}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Tên phim</th>";
            echo "<td>{$this->title}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Giá vé</th>";
            echo "<td>" . number_format($this->price) . " VNĐ</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Tổng số ghế</th>";
            echo "<td>{$this->totalSeats}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Số ghế còn lại</th>";
            echo "<td>{$this->availableSeats}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Số vé đã bán</th>";
            echo "<td>{$this->getSoldSeats()}</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>Doanh thu</th>";
            echo "<td>" . number_format($this->getRevenue()) . " VNĐ</td>";
            echo "</tr>";

            echo "</table>";

            echo "<br>";
        }
    }

    function findMovieById($movies, $id){
        foreach($movies as $movie){
            if ($movie->id == $id){
                return $movie;
            }
        }
        return null;
    }

    function getTotalRevenue($movies){
        $total =0;
        foreach($movies as $movie){
            $total+=$movie->getRevenue();
        }
        return $total;
    }

    function getBestSellingMovie($movies){
        if(empty($movies)){
            return null;
        }
        
        $bestMovie=$movies[0];
        foreach ($movies as $movie){
            if ($movie->getSoldSeats() > $bestMovie->getSoldSeats()){
                $bestMovie=$movie;
            }
        }
        return $bestMovie;
    }
    echo "<h2>QUẢN LÝ VÉ XEM PHIM</h2>";

    $movie1 = new Movie(1, "Avengers", 100000, 100);
    $movie2 = new Movie(2, "Avatar", 120000, 80);
    $movie3 = new Movie(3, "Batman", 90000, 120);

    $movies = [
        $movie1,
        $movie2,
        $movie3
    ];

    echo "<h3>Đặt vé</h3>";

    $unknownMovie = findMovieById($movies, 999);

    if ($unknownMovie == null) {
        echo "Không tìm thấy phim có ID = 999.<br>";
    }

    $avengers = findMovieById($movies, 1);

    if ($avengers != null) {
        $avengers->bookTicket(0);
        $avengers->bookTicket(2);
    }

    $avatar = findMovieById($movies, 2);

    if ($avatar != null) {
        $avengers->bookTicket(100);
        $avatar->bookTicket(5);
    }

    echo "<h3>Hủy vé</h3>";

    if ($avengers != null) {
        $avengers->cancelTicket(0);
        $avengers->cancelTicket(7);
        $avengers->cancelTicket(2);
    }

    echo "<h3>Các bộ phim đang chiếu</h3>";

    foreach ($movies as $movie) {
        $movie->displayInfo();
    }

    echo "<h3>Tổng doanh thu</h3>";

    $totalRevenue = getTotalRevenue($movies);

    echo "Tổng doanh thu: "
        . number_format($totalRevenue)
        . " VNĐ<br>";

    echo "<h3>Phim có số vé bán ra nhiều nhất</h3>";

    $bestSellingMovie = getBestSellingMovie($movies);

    if ($bestSellingMovie != null) {
        echo "Tên phim: <strong>"
            . $bestSellingMovie->title
            . "</strong><br>";

        echo "Số vé đã bán: "
            . $bestSellingMovie->getSoldSeats()
            . " vé<br>";
    }
    
    $emptyMovies = [];

    echo "<br>";

    $totalEmptyRevenue = getTotalRevenue($emptyMovies);

    echo "Tổng doanh thu khi danh sách rỗng: "
        . number_format($totalEmptyRevenue)
        . " VNĐ<br>";

    $bestEmptyMovie = getBestSellingMovie($emptyMovies);

    if ($bestEmptyMovie == null) {
        echo "Danh sách phim rỗng, không có phim bán chạy nhất.<br>";
    }

?>