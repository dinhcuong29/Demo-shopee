<?php
require("../config.php");
session_start();
if(!$_SESSION["role"]){
    header("location:../login.php");
   }
if(isset($_POST["insert"])){
    $name= $_POST["name"];
    $price_old = $_POST["price_old"];
    $price_current = $_POST["price_current"];
    $sale = $_POST["sale"];
    $sell = $_POST["sell"];
    $cate_id = $_POST["cate_id"];
    $date = $_POST["date"];
    // Xác định thư mục lưu trữ ảnh
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
        }
        else{
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                //viet cau truy van de insert du lieu
                $sql_insert = "insert into sanpham(name, image, price_old,price_current, sale,sell,cate_id, date) values(N'".$name."','".$target_file."','".$price_old."','".$price_current."','".$sale."','".$sell."','".$cate_id."','".$date."')";
                if (mysqli_query($conn, $sql_insert)) {
                    //echo "New record created successfully";
                    header("location:sanpham.php");
                } 
                else {
                    echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
                }       
            }
            else{
                echo "co loi upload";
            }
        }
    }



// Xóa dl

if(isset($_GET["task"]) && $_GET["task"] == "delete"){
    $id = $_GET["id"];
    $sql_delete = "delete from sanpham where id =".$id;

if (mysqli_query($conn,$sql_delete)){
    header("location:sanpham.php");
}
else{
    echo "Eror : " .$sql."<br>". mysqli_error($conn);
}
}

// Xóa Chọn
if(isset($_POST["delete_check"])){
    $id = $_POST["sanpham"];
    foreach($id as $c){
        $sql_delete = "delete from sanpham where id =".$c;
        if (mysqli_query($conn,$sql_delete)){
            header("location:sanpham.php");
        }
    }
}


if(isset($_POST["delete_all"])){
    $sql_delete_all = "DELETE FROM sanpham";
    if ($conn->query($sql_delete_all) === TRUE) {
        echo "Dữ liệu đã được xóa thành công";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    </style>
</head>
<body style="background-color:#ffffcc; ;">
    <div class="container">
        <h1 style="text-align: center;">Trang Quản Trị Sản Phẩm</h1>
        <div class="row">
            <div class="col-6">
                <form action="sanpham.php" method="post" enctype="multipart/form-data">
                    Tên sản phẩm :
                    <input type="text" class="form-control"  name="name">
                    Chọn ảnh :
                    <input class="form-control" type="file" name="image">
                    Giá cũ (Triệu đồng):
                    <input type="text" class="form-control"  name="price_old">
                    Giá mới (Triệu đồng):
                    <input type="text" class="form-control"  name="price_current">
                    Giảm giá (%):
                    <input type="number" class="form-control"  name="sale">
                    Đã bán (Nghìn) :
                    <input type="number" class="form-control"  name="sell">
                    Mã Danh Mục:
                    <select class="form-control" name="cate_id" id="">
                        <?php
                            $sql = "select * from tbl_category order by cate_id DESC";
                            $result = mysqli_query($conn,$sql);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row["cate_id"]."'>".$row["cate_id"]."</option>";
                                }
                            }
                        ?> 
                    </select>
                    Ngày đăng:
                    <input type="date" class="form-control"  name="date">
                    <br>
                    <input class="btn btn-primary" type="submit" value="Thêm Mới" name="insert" id="insert" >
                    <br>
                    <br>
                    <input placeholder="Nhập tên sản phẩm..." class="form-control" type="text" name="txt_seach">
                    <br>
                    <input class="btn btn-success" type="submit" value="Tìm Kiếm" name="seach" >

                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
            <?php
                         $result = mysqli_query($conn, 'select count(cate_id) as total from sanpham');
                         $row = mysqli_fetch_assoc($result);
                         $total_records = $row['total'];
                         //tim limit va current page
                         $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $limit = 5;
                        // BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
                        // tổng số trang
                        $total_page = ceil($total_records / $limit);
                        
                        // Giới hạn current_page trong khoảng 1 đến total_page
                        if ($current_page > $total_page){
                            $current_page = $total_page;
                        }
                        else if ($current_page < 1){
                            $current_page = 1;
                        }
                        
                        // Tìm Start
                        $start = ($current_page - 1) * $limit;
                    ?>
                <table class="table table-stripped">
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Sản phẩm</th>
                        <th>Giá cũ</th>
                        <th>Giá mới</th>
                        <th>Giảm giá</th>
                        <th>Đã bán</th>
                        <th>Tên danh mục</th>
                        <th>Ngày đăng</th>
                        <th>Thao tác</th>
                        <th>Chọn</th>
                    </tr>
                <form action="sanpham.php" method="post">
                <input type="submit" value="Xóa mục đã chọn" name="delete_check" class="btn btn-info">
                <input type="submit" value="Xoá tất cả" name="delete_all" class="btn btn-danger">            
                <?php
                $sql="";
                if(isset($_POST["seach"]))
                {
                    $sql="select*from sanpham where name like '%".$_POST["txt_seach"]."%'";
                }else{
                    $sql = "select*from sanpham LIMIT $start, $limit";
                }
                $result = mysqli_query($conn,$sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    {
                        $s = "";
                        if($row["cate_id"]==2){
                            $s = "<p style='color:red'>Thời Trang</p>";
                        }
                        else
                        {
                            $s = "<p style='color:blue'>Thiết Bị Điện Tử</p>";
                        }
                    }
                    
                    echo"<tr>";
                    echo"<td>".$row["id"]."</td>";
                    // echo"<td>".$a."</td>";
                    echo"<td>".$row["name"]."</td>";
                    echo"<td>";
                    echo "<img src='". $row["image"] . "' style='width:100px;height:80px;'>";
                    echo"</td>";
                    echo"<td>".$row["price_old"].".000.000đ</td>";
                    echo"<td>".$row["price_current"].".000.000đ</td>";
                    echo"<td>".$row["sale"]."%</td>";
                    echo"<td>".$row["sell"]."k</td>";
                    echo"<td>".$s."</td>";
                    echo"<td>".$row["date"]."</td>";
                    // echo"<td>".$d."</td>";
                    echo"<td>";
                    echo" <a class='btn btn-danger' href='sanpham.php?task=delete&id=".$row["id"]."' >Xóa </a> "; 
                    echo" <a class='btn btn-warning' href='./update_sp.php?task=update&id=".$row["id"]."' >Sửa </a>" ;
                    echo"</td>";
                    echo "<td>";
                    echo "<input type='checkbox' name='sanpham[]' value='".$row["id"]."' class='form-check-input'>";
                    echo"</td>";
                    echo"</tr>";
                }
                }

                else {
                echo "0 results";
                }
                $conn->close();
                ?>
                    </form>
                </table>                   
            </div>
            <div class="pagination">
                            <?php 
                                // PHẦN HIỂN THỊ PHÂN TRANG
                                // BƯỚC 7: HIỂN THỊ PHÂN TRANG
                    
                                // nếu current_page > 1 và total_page > 1 mới hiển thị nút prev
                                if ($current_page > 1 && $total_page > 1){
                                    echo '<a href="sanpham.php?page='.($current_page-1).'">Prev</a> | ';
                                }
                    
                                // Lặp khoảng giữa
                                for ($i = 1; $i <= $total_page; $i++){
                                    // Nếu là trang hiện tại thì hiển thị thẻ span
                                    // ngược lại hiển thị thẻ a
                                    if ($i == $current_page){
                                        echo '<span>'.$i.'</span> | ';
                                    }
                                    else{
                                        echo '<a href="sanpham.php?page='.$i.'">'.$i.'</a> | ';
                                    }
                                }
                    
                                // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                                if ($current_page < $total_page && $total_page > 1){
                                    echo '<a href="sanpham.php?page='.($current_page+1).'">Next</a> | ';
                                }
                            ?>
                        </div>

        </div>

    </div>
    
</body>
</html> 
