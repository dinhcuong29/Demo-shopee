<?php
require("config.php");
session_start();
if(!$_SESSION["user"]){
    header("location:./login.php");
}
if(isset($_SESSION["cart"])){
    // echo var_dump($_SESSION["cart"]);
    // if(isset($_POST["addtoorder"])){
    //     $name = $_POST["name"];
    //     $address = $_POST["address"];
    //     $tel = $_POST["tel"];
    //     $email = $_POST["email"];
    //     $pttt = $_POST["pttt"];
    //     $madh = rand(0,999999);
    //     //viet cau truy van de insert di lieu
    //     $sql_insert = "insert into tbl_order(name,address,tel,email,pttt,madh) values(N'".$name."',N'".$address."',".$tel.",N'".$email."',".$pttt.",".$madh.")";
    //     if (mysqli_query($conn, $sql_insert)) {
    //         //echo "New record created successfully";
    //         header("location:cart.php");
    //     }
    //     else{
    //         echo "Error: " . $sql . "<br>" . mysqli_error($conn) ;
    //     }
    // }

   
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
        <h1 style="text-align: center;">Đơn Hàng </h1>
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
                echo"<td>".$ttien.".000.000đ</td>";
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
                </tr>
                </table>
                
                <div class="thaotac">
                <!-- <a href="delete_cart.php">Xóa giỏ hàng</a> -->
                <a href="shop.php">Quay lại</a>
                </div>
            </div>
            <div class="col-3">
                    <input class="form-control" type="text" name="name" placeholder="Nhập Họ Tên"><br>
                    <input class="form-control" type="text" name="address" placeholder="Nhập Địa Chỉ"><br>
                    <input class="form-control" type="text" name="tel" placeholder="Nhập SĐT"><br>
                    <input class="form-control" type="text" name="email" placeholder="Nhập Email"><br>
                    Phương Thức Thanh Toán:
                    <br>
                    <input type="radio" name="pttt" value="1"> Thanh Toán Khi Nhận Hàng <br>
                    <input type="radio" name="pttt" value="2"> Thanh Toán Onlie <br>
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


