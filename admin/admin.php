<?php
require("../config.php");
session_start();
if(!$_SESSION["role"]){
    header("location:../login.php");
   }
?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <style>
        a{
            text-decoration: none;
            color: black;
        }
    </style>
    </head>
    <body>
        <div class="container">
            <h1 style="text-align: center;">Admin</h1>
            <div class="row">
                <ul>
                    <li>
                        <a href="category.php">Quản trị danh mục</a>
                    </li>
                    <li>
                        <a href="sanpham.php">Quản trị sản phẩm</a>
                    </li>
                    <li>
                        <a href="order.php">Quản trị thông tin đơn hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>