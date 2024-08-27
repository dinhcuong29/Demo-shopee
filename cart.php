<?php
require("config.php");
session_start();
if(!$_SESSION["user"]){
    header("location:./login.php");
}
if(isset($_SESSION["cart"])){
//     // echo var_dump($_SESSION["cart"]);
if(isset($_SESSION["cart"])) {
    if(isset($_POST["addtoorder"])) {
        $name = $_POST["name"];
        $address = $_POST["address"];
        $tel = $_POST["tel"];
        $email = $_POST["email"];
        $pttt = $_POST["pttt"];
        $tong=$_POST["tong"];
        $madh = rand(0,999999);

        // Tạo mảng để chứa các câu truy vấn
        $insert_queries = [];

        // Câu truy vấn chèn dữ liệu vào bảng tbl_order
        $insert_queries[] = "INSERT INTO tbl_order(name, address, tel, email, pttt,tong, madh) VALUES(N'" . $name . "', N'" . $address . "', " . $tel . ", N'" . $email . "', " . $pttt . "," . $tong . ", " . $madh . ")";

        // Chèn dữ liệu vào bảng cart cho mỗi sản phẩm trong giỏ hàng
        foreach($_SESSION["cart"] as $sp) {
            $insert_queries[] = "INSERT INTO cart(madh, id_sanpham, name_sp, img_sp, price, sl) VALUES(" . $madh . ", " . $sp[0] . ", N'" . $sp[1] . "', N'" . $sp[2] . "', " . $sp[3] . ", " . $sp[4] . ")";
        }

        // Thực hiện tất cả các câu truy vấn
        foreach($insert_queries as $query) {
            if (!mysqli_query($conn, $query)) {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
                exit; // Thoát khỏi vòng lặp nếu có lỗi
            }
        }

        // echo "New record(s) created successfully";
        header("location:donhang.php");
    }
}


   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style> 
     table{
            text-align: center;
            border : 1px solid #333;
        }
    th,td{
            border-bottom: 1px solid #333;
        }
    a{
        color: #000;
        text-decoration: none;
    }
    .thaotac{
        justify-content:space-between;
        display: flex;
    }
    .cart_sp{
        background-color: #fff;
        width:100%;
        text-align: center;
    }
    .cart_sp img{
        width: 25%;
        margin-top: 55px;
    }
    </style>
</head>
<body style="background-color:#ffffcc; ;">
    <div class="container">
        <h1 style="text-align: center;">Giỏ Hàng</h1>
        <br>
        <div class="row">
            <div class="col-9">
                <table class="table table-stripped">
                    <tr>
                        <th>STT</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Sản Phẩm</th>
                        <th>Giá </th>
                        <th>Số Lượng</th>
                        <th>Thành Tiền</th>
                        <th>Thao Tác</th>
                    </tr>          
                <?php
                $i=0;
                $tong=0;
                foreach($_SESSION["cart"] as $sp){
                $ttien=$sp[3]*$sp[4];
                $tong+=$ttien;
                echo "<tr>";
                echo "<td>".($i+1)."</td>";  
                echo"<td>".$sp["1"]."</td>";
                echo"<td>";
                echo "<img src='./admin/". $sp["2"] . "' style='width:100px;height:80px;'>";
                echo"</td>";
                echo"<td>".$sp["3"].".000.000đ</td>";
                echo"<td>".$sp["4"]."</td>";
                echo"<td >".$ttien.".000.000đ</td>";
                echo"<td>";
                echo "<a class='btn btn-danger' href='delete_cart.php?id=".$i."'>Xóa</a>";
                echo"</td>";
                echo"</tr>";
                $i++;
                }
                ?>
                <tr>
                    <td>Thanh Toán</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?=$tong?>.000.000đ</td>
                    <td></td>
                </tr>
                </table>
                
                <div class="thaotac">
                <a href="delete_cart.php">Xóa giỏ hàng</a>
                <a href="shop.php">Quay lại</a>
                </div>
            </div>
            <div class="col-3">
                <form action="cart.php" method="post">
                    <input class="form-control" type="text" name="name" placeholder="Nhập Họ Tên"><br>
                    <input class="form-control" type="text" name="address" placeholder="Nhập Địa Chỉ"><br>
                    <input class="form-control" type="text" name="tel" placeholder="Nhập SĐT"><br>
                    <input class="form-control" type="text" name="email" placeholder="Nhập Email"><br>
                    <input type="hidden" name="tong" value="<?=$tong?>">
                    Phương Thức Thanh Toán:
                    <br>
                    <input type="radio" name="pttt" value="1"> Thanh Toán Khi Nhận Hàng <br>
                    <input type="radio" name="pttt" value="2"> Thanh Toán Onlie <br>
                    <input type="submit" name="addtoorder" value="Xuất Đơn Hàng">
                </form>
    </div>
        </div>
    </div>

</body>

</html> 
<?php   
}
else{
    echo'
    <div class="cart_sp">
    <img src="../images/spt.png" alt="">
    <p>Chưa có sản phẩm</p>
    <a href="shop.php">Quay lại</a>
    </div>';
}

?>


