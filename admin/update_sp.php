<?php
require("../config.php");
session_start();
if(!$_SESSION["role"]){
    header("location:../login.php");
   }
if(isset($_POST["b_update"])) {
    $id = $_POST["id"];
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
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Xin lỗi, chỉ cho phép tải lên các file JPG, JPEG, PNG và GIF.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Xin lỗi, file của bạn không được tải lên.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Xử lý upload file thành công, tiến hành cập nhật cơ sở dữ liệu
            $image = basename($_FILES["image"]["name"]);
            $sql_update = "UPDATE sanpham SET name=N'$name', price_old=N'$price_old', image='$target_file', price_current=N'$price_current',sale='$sale',sell='$sell' ,cate_id='$cate_id' ,date='$date' WHERE id=$id";
            if (mysqli_query($conn, $sql_update)) {
                header("location:sanpham.php");
            } else {
                echo "Lỗi: " . $sql_update . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Có lỗi khi upload file.";
        }
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
    
</head>
<body style="background-color:#ffffcc; ;">
    <div class="container">
        <h1 style="text-align: center;">Cập Nhật Sản Phẩm</h1>
        <div class="row">
            <div class="col-6">

<form action="update_sp.php" method="post" enctype="multipart/form-data">
<?php
if(isset($_GET["task"]) && $_GET["task"] == "update"){
    $id = $_GET["id"];
    $sql_select = "select*from sanpham where id =".$id;
    $result= mysqli_query($conn,$sql_select);
}
if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) 
        {
            echo"<input type='hidden' name='id' value='".$row["id"]."'>";
            echo"Tên sản phẩm:";
            echo"<input values='".$row["name"]."' class='form-control'  type = 'text' name='name' id=''>";
            echo"Sản phẩm:";
            echo"<input values='".$row["image"]."' class='form-control'  type = 'file' name='image' id=''>";
            echo"Giá cũ ( Triệu đồng ) :";
            echo"<input values='".$row["price_old"]."' class='form-control'  type = 'text' name='price_old' id=''>";
            echo"Giá mới ( Triệu đồng ) :";
            echo"<input values='".$row["price_current"]."' class='form-control'  type = 'text' name='price_current' id=''>";
            echo"Giảm giá ( %) :";
            echo"<input values='".$row["sale"]."' class='form-control'  type = 'text' name='sale' id=''>";
            echo"Đã bán (Nghìn) :";
            echo"<input values='".$row["sell"]."' class='form-control'  type = 'text' name='sell' id=''>";
            echo"Mã danh mục:";
            echo"<input values='".$row["cate_id"]."' class='form-control'  type = 'number' name='cate_id' id=''>";
            echo"Ngày đăng:";
            echo"<input values='".$row["date"]."' class='form-control'  type = 'date' name='date' id=''>";
        }
}
?>
<br>
<input class=" btn btn-primary" type="submit" value="Cập Nhật " name="b_update">
</form>


            </div>

        </div>

    </div>
    
</body>
</html>