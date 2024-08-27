<?php
require("../config.php");
session_start();
if(!$_SESSION["role"]){
    header("location:../login.php");
   }
{
if(isset($_POST["btn_update"])){
    $cate_id = $_POST["cate_id"];
    $name= $_POST["cate_name"];
    $status = $_POST["status"];
    $sql_update="update tbl_category set cate_name=N'".$name."' ,status=N'".$status."'where cate_id=".$cate_id;
    if (mysqli_query($conn,$sql_update)){
        header("location:category.php");
    }
    else{
        echo "Error : " .$sql_update."<br>". mysqli_error($conn);
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
        <h1 style="text-align: center;">Cập Nhật</h1>
        <div class="row">
            <div class="col-6">

<form action="update_cate.php" method="post" >
<?php
if(isset($_GET["task"]) && $_GET["task"] == "update"){
    $id = $_GET["id"];
    $sql_select = "select*from tbl_category where cate_id =".$id;
    $result= mysqli_query($conn,$sql_select);
}
if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) 
        {
             echo"<input type='hidden' name='cate_id' value='".$row["cate_id"]."'>";
             echo"Tên danh mục:";
             echo"<input values='".$row["cate_name"]."' class='form-control'  type = 'text' name='cate_name' id=''>";
             echo"Trạng thái:";
             echo"<input values='".$row["status"]."' class='form-control'  type = 'number' name='status' id=''>";
        }
}
?>
<br>
<input class=" btn btn-primary" type="submit" value="Cập Nhật " name="btn_update">
</form>


            </div>

        </div>

    </div>
    
</body>
</html>