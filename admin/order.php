<?php
require("../config.php");  
//order
 //xoa du lieu
 if(isset($_GET["task"])&& $_GET["task"]=="delete"){
    $id = $_GET["id"];
    $sql_delete = "delete from tbl_order where id = ".$id;
    if (mysqli_query($conn, $sql_delete)) {
        //echo "New record created successfully";
        header("location:order.php");
    }
    else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) ;
    }
}

if(isset($_POST["delete_check"])){
    $id = $_POST["od"];
    foreach($id as $c){
        $sql_delete = "delete from tbl_order where id = ".$c;
        if (mysqli_query($conn, $sql_delete)) {
            //echo "New record created successfully";
            header("location:order.php");
        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn) ;
        }
    }
}

if(isset($_POST["delete_all"])){
    $sql_delete_all = "DELETE FROM tbl_order";
    if ($conn->query($sql_delete_all) === TRUE) {
        echo "Dữ liệu đã được xóa thành công";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
}




//cart
//xoa du lieu
if(isset($_GET["task"])&& $_GET["task"]=="delete1"){
    $id = $_GET["id"];
    $sql_delete = "delete from cart where id = ".$id;
    if (mysqli_query($conn, $sql_delete)) {
        //echo "New record created successfully";
        header("location:order.php");
    }
    else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn) ;
    }
}

if(isset($_POST["delete_check"])){
    $id = $_POST["ca"];
    foreach($id as $d){
        $sql_delete = "delete from cart where id = ".$d;
        if (mysqli_query($conn, $sql_delete)) {
            //echo "New record created successfully";
            header("location:order.php");
        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn) ;
        }
    }
}

if(isset($_POST["delete_all"])){
    $sql_delete_all = "DELETE FROM cart";
    if ($conn->query($sql_delete_all) === TRUE) {
        echo "Dữ liệu đã được xóa thành công";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
}
?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    </head>
    <body style="background-color: #ffffcc;">
        <div class="container">
            <h1 style="text-align: center;">Trang Quản Trị Thông Tin Đơn Hàng</h1>
            <div class="row">
                <h1>Order</h1>
                <div class="col-12">
                    <table class="table table-stripped">
                        <tr>
                            <th>id</th>
                            <th>Mã đơn hàng</th>
                            <th>Người đặt</th>
                            <th>Địa chỉ</th>
                            <th>SĐT</th>
                            <th>Email</th>
                            <th>Phương thức thanh toán</th>
                            <th>Tổng đơn hàng</th>
                            <th>Thao Tác</th>
                            <th>Chọn</th>
                        </tr>
                    <form action="order.php" method="post">
                            <input type="submit" value="Xóa Chọn " name="delete_check" class="btn btn-info">
                            <input type="submit" value="Xóa Tất Cả" name="delete_all" class="btn btn-danger">
                    <?php  
                        $sql = "select * from tbl_order";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                            $s ="";
                                    if($row["pttt"]==1){
                                        $s = "<p style='color:red'>Thanh toán khi nhận hàng</p>";
                                    }
                                    else
                                    {
                                        $s = "<p style='color:green'>Thanh toán online</p>";
                                    }
                            echo "<tr>";
                            echo "<td>".$row["id"]."</td>";
                            echo "<td>".$row["madh"]."</td>";
                            echo "<td>".$row["name"]."</td>";
                            echo "<td>".$row["address"]."</td>";
                            echo "<td>0".$row["tel"]."</td>";
                            echo "<td>".$row["email"]."</td>";
                            echo "<td>".$s."</td>";
                            // echo "<td>".$row["pttt"]."</td>";
                            echo "<td>".$row["tong"].".000.000đ</td>";
                            echo "<td>";
                                // echo "<a class='btn btn-warning' href='update_od.php?task=update&id=".$row["id"]."'>Sửa</a>";
                                echo "<a class='btn btn-danger' href='order.php?task=delete&id=".$row["id"]."'>Xóa</a>";
                            echo "</td>";
                            echo "<td>";
                                echo "<input type='checkbox' name='od[]' value='".$row["id"]."' class='form-check-input'>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        } else {
                        echo "0 results";
                        }
                    ?>
                    </form>
                   </table>
               </div>




               <h1>Cart</h1>
                <div class="col-12">
                    <table class="table table-stripped">
                        <tr>
                            <th>id</th>
                            <th>Mã đơn hàng</th>
                            <th>Mã sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tên sản phẩm</th>
                            <th>Sản phẩm</th>
                            <th>Thao Tác</th>
                            <th>Chọn</th>
                        </tr>
                    <form action="order.php" method="post">
                            <input type="submit" value="Xóa Chọn " name="delete_check" class="btn btn-info">
                            <input type="submit" value="Xóa Tất Cả" name="delete_all" class="btn btn-danger">
                    <?php  
                        $sql = "select * from cart";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) 
                        {
                            echo "<tr>";
                            echo "<td>".$row["id"]."</td>";
                            echo "<td>".$row["madh"]."</td>";
                            echo "<td>".$row["id_sanpham"]."</td>";
                            echo "<td>".$row["price"].".000.000đ</td>";
                            echo "<td>0".$row["sl"]."</td>";
                            echo "<td>".$row["name_sp"]."</td>";
                            echo"<td>";
                            echo "<img src='". $row["img_sp"] . "' style='width:100px;height:80px;'>";
                            echo "<td>";
                                // echo "<a class='btn btn-warning' href='update_od.php?task=update&id=".$row["id"]."'>Sửa</a>";
                                echo "<a class='btn btn-danger' href='order.php?task=delete1&id=".$row["id"]."'>Xóa</a>";
                            echo "</td>";
                            echo "<td>";
                                echo "<input type='checkbox' name='ca[]' value='".$row["id"]."' class='form-check-input'>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        } else {
                        echo "0 results";
                        }
                    ?>
                    </form>
                   </table>
               </div>
         </div>
       </div>
    </body>
</html>
