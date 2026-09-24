<?php
    class CartItem{
        public $name;
        public $price;
        public $quantity;

        public function __construct($name, $price, $quantity)
        {
            $this->name = $name;
            $this->price = $price;
            $this->quantity = $quantity;
        }

        public function getTotal(){
            return $this->price*$this->quantity;
        }
    }

    class ShoppingCart{
        public $items = [];

        public function addItem($item){
            if (!($item instanceof CartItem)){
                echo"Không tồn tại sản phẩm này!"."<br>";
                return;
            }

            if ($item->price <= 0){
                echo "Không thể thêm sản phẩm '{$item->name}'. Giá sản phẩm phải lớn hơn 0"."<br>";
                return;
            }

            if ($item->quantity <= 0){
                echo "Không thể thêm sản phẩm '{$item->name}'. Số lượng sản phẩm phải lớn hơn 0"."<br>";
                return;
            }

            $this->items[] = $item;
            echo "Đã thêm sản phẩm '{$item->name}' vào giỏ hàng."."<br>";
        }

        public function removeItem($name){
            foreach ($this->items as $key=>$item){
                if ($item->name == $name){
                    unset($this->items[$key]);
                    echo "Đã xóa sản phảm '{$name}' khỏi giỏ hàng."."<br>";
                    return;
                }
            }
            echo "Không tìm thấy sản phẩm '{$name}' trong giỏ hàng."."<br>";
        }

        public function calculateTotal(){
            $total=0;
            foreach ($this->items as $item){
                $total+=$item->getTotal();
            }
            return $total;
        }

        public function displayCart(){
            if (empty($this->items)){
                echo "Giỏ hàng trống."."<br>";
                return;
            }
            echo "<table border='1' cellpadding='8' cellspacing='0'>";
            echo "<tr>";
            echo "<th>Tên sản phẩm</th>";
            echo "<th>Đơn giá</th>";
            echo "<th>Số lượng</th>";
            echo "<th>Thành tiền</th>";
            echo "</tr>";

            foreach ($this->items as $item) {
                echo "<tr>";
                echo "<td>{$item->name}</td>";
                echo "<td>" . number_format($item->price) . " VNĐ</td>";
                echo "<td>{$item->quantity}</td>";
                echo "<td>" . number_format($item->getTotal()) . " VNĐ</td>";
                echo "</tr>";
            }

            echo "</table>";

            echo "<p><strong>Tổng tiền: "
                . number_format($this->calculateTotal())
                . " VNĐ</strong></p>";
            }
    }

    echo "<h2>GIỎ HÀNG MUA SẮM</h2>";

    $cart = new ShoppingCart();

    $item1 = new CartItem("Gạo lứt tím Vinh Hiển túi 1kg", 48000, 2);
    $item2 = new CartItem("Lốc 4 hộp sữa tươi tiệt trùng rất ít đường Vinamilk Green Farm 180ml", 42000, 5);
    $item3 = new CartItem("Dầu thực vật Tường An Cooking Oil chai 1 lít", 59000, 2);
    $item4 = new CartItem("Mì Hảo Hảo", 5000, 20);
    $item5 = new CartItem("Nước mắm Nam Ngư Phú Quốc đậm đặc 32 độ đạm chai 500ml", 71000, 2);
    $item6 = new CartItem("Đường kính trắng An Khê gói 1kg", 26000, 3);
    $item7 = new CartItem("Trứng gà hộp 10 quả", 24000, 3);
    $item8 = new CartItem("Oreo", 12000, 2);

    echo "<h3>Thêm sản phẩm</h3>";

    $cart->addItem($item1);
    $cart->addItem($item2);
    $cart->addItem($item3);
    $cart->addItem($item4);
    $cart->addItem($item5);
    $cart->addItem($item6);
    $cart->addItem($item7);
    $cart->addItem($item8);
    $invalidPrice = new CartItem("Sản phẩm giá 0", 0, 1);
    $cart->addItem($invalidPrice);
    $invalidQuantity = new CartItem("Sản phẩm số lượng 0", 100000, 0);
    $cart->addItem($invalidQuantity);

    echo "<h3>Giỏ hàng ban đầu</h3>";
    $cart->displayCart();

    echo "<h3>Tổng tiền</h3>";

    echo "Tổng tiền giỏ hàng: "
        . number_format($cart->calculateTotal())
        . " VNĐ<br>";


    echo "<h3>Xóa sản phẩm</h3>";

    $cart->removeItem("Oreo");
    $cart->removeItem("Thịt bò");

    echo "<h3>Giỏ hàng sau khi xóa</h3>";
    $cart->displayCart();
?>