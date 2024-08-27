<?php
session_start();
// Kiểm tra xem có giỏ hàng trong phiên làm việc hay không
if (isset($_SESSION["cart"])) {
    // Kiểm tra xem có tham số "id" được chuyển đến qua URL hay không
    if (isset($_GET["id"])) {
        // Loại bỏ sản phẩm khỏi giỏ hàng
        array_splice($_SESSION["cart"], $_GET["id"], 1);
    } else {
        // Nếu không có tham số "id," xóa toàn bộ giỏ hàng
        unset($_SESSION["cart"]);
    }

    // Kiểm tra xem giỏ hàng còn sản phẩm hay không
    if (!empty($_SESSION["cart"])) {
        header("location: cart.php");
    } else {
        header("location: shop.php");
    }
}
// } else {
//     echo "Giỏ hàng trống.";
// }
?>

