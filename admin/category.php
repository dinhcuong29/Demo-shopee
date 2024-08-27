<?php
    require("../config.php");
    session_start();
    if(!$_SESSION["role"]){
        header("location:../login.php");
   }
    
    if(isset($_POST["insert"])){
        $cate_name = $_POST["txt_cate_name"];
        $status = $_POST["txt_status"];
        //viet cau truy van de insert di lieu
        $sql_insert = "insert into tbl_category(cate_name, status) values(N'".$cate_name."',".$status.")";
        if (mysqli_query($conn, $sql_insert)) {
            //echo "New record created successfully";
            header("location:category.php");
        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn) ;
        }
    }

    //xoa du lieu
    if(isset($_GET["task"])&& $_GET["task"]=="delete"){
        $id = $_GET["id"];
        $sql_delete = "delete from tbl_category where cate_id = ".$id;
        if (mysqli_query($conn, $sql_delete)) {
            //echo "New record created successfully";
            header("location:category.php");
        }
        else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn) ;
        }
    }

    if(isset($_POST["delete_check"])){
        $cate_id = $_POST["cate"];
        foreach($cate_id as $c){
            $sql_delete = "delete from tbl_category where cate_id = ".$c;
            if (mysqli_query($conn, $sql_delete)) {
                //echo "New record created successfully";
                header("location:category.php");
            }
            else{
                echo "Error: " . $sql . "<br>" . mysqli_error($conn) ;
            }
        }
    }

    if(isset($_POST["delete_all"])){
        $sql_delete_all = "DELETE FROM tbl_category";
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
    <style>
            .pagination a{
                border:1px solid black;
                padding:5px;
                text-decoration: none;
                
            }
        </style>
    </head>
    <body style="background-color: #ffffcc;">
        <div class="container">
            <h1 style="text-align: center;">Trang Quản Trị Danh Mục</h1>
            <div class="row">
                <div class="col-6">
                    <form action="category.php" method="post">
                        Nhập Tên Danh Mục :
                        <input class="form-control" type="text" name="txt_cate_name" id="">
                        Nhập Trạng Thái :
                        <input class="form-control" type="text" name="txt_status" id="">
                        <br>
                        <input class="btn btn-primary" type="submit" value="Thêm Mới" name="insert" id="">
                        <br>
                        <br>
                        <input placeholder="Nhập vào tên danh mục..." class="form-control" type="text" name="txt_search" id="">
                        <br>
                        <input class="btn btn-success" type="submit" value="search" name="search" id="">
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <?php
                         $result = mysqli_query($conn, 'select count(cate_id) as total from tbl_category');
                         $row = mysqli_fetch_assoc($result);
                         $total_records = $row['total'];
                         //tim limit va current page
                         $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $limit = 3;
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
                            <th>Mã Danh Mục</th>
                            <th>Tên Danhh Mục</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                            <th>Chọn</th>
                        </tr>
                        <form action="category.php" method="post">
                            <input type="submit" value="Xóa Chọn " name="delete_check" class="btn btn-info">
                            <input type="submit" value="Xóa Tất Cả" name="delete_all" class="btn btn-danger">
                        <?php
                            $sql = "";
                            if(isset($_POST["search"]))
                            {
                                $sql = "select * from tbl_category where cate_name like '%".$_POST["txt_search"]."%'";
                            }
                            else{
                                $sql = "select * from tbl_category LIMIT $start, $limit";
                            }
                            $result = mysqli_query($conn,$sql);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) 
                                {
                                    $s ="";
                                    if($row["status"]==0){
                                        $s = "<p style='color:red'>Không duyệt</p>";
                                    }
                                    else
                                    {
                                        $s = "<p style='color:green'>Duyệt</p>";
                                    }
                                    echo "<tr>";
                                    echo "<td>".$row["cate_id"]."</td>";
                                    echo "<td>".$row["cate_name"]."</td>";
                                    echo "<td>".$s."</td>";
                                    echo "<td>";
                                        echo "<a class='btn btn-warning' href='update_cate.php?task=update&id=".$row["cate_id"]."'>Sửa</a>";
                                        echo "<a class='btn btn-danger' href='category.php?task=delete&id=".$row["cate_id"]."'>Xóa</a>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<input type='checkbox' name='cate[]' value='".$row["cate_id"]."' class='form-check-input'>";
                                    echo "</td>";
                                    echo "</tr>";
                                    // echo $row["cate_id"] . "," . $row["cate_name"] . "<br>";
                                }
                            } 
                            else {
                                echo "0 results";
                            }
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
                                    echo '<a href="category.php?page='.($current_page-1).'">Prev</a> | ';
                                }
                    
                                // Lặp khoảng giữa
                                for ($i = 1; $i <= $total_page; $i++){
                                    // Nếu là trang hiện tại thì hiển thị thẻ span
                                    // ngược lại hiển thị thẻ a
                                    if ($i == $current_page){
                                        echo '<span>'.$i.'</span> | ';
                                    }
                                    else{
                                        echo '<a href="category.php?page='.$i.'">'.$i.'</a> | ';
                                    }
                                }
                    
                                // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
                                if ($current_page < $total_page && $total_page > 1){
                                    echo '<a href="category.php?page='.($current_page+1).'">Next</a> | ';
                                }
                            ?>
                </div>
            </div>
        </div>
    </body>
</html>