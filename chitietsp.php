<?php
require("config.php");
// Kiểm tra xem có tham số "id" trong URL hay không
if (isset($_GET["id"])) {
    $sql = "SELECT * FROM sanpham WHERE id = {$_GET["id"]}";   
    // Thực hiện truy vấn
    $result = $conn->query($sql);

    // Lấy kết quả của truy vấn
    $sanpham = mysqli_fetch_assoc($result);

    // Hiển thị dữ liệu
    // var_dump($sanpham);

} else {
    echo "Tham số 'id' không hợp lệ.";
}


session_start();
if(isset($_POST["add"]) && ($_POST["add"])){
    // lấy giá trị
    $id=$_POST["id"];
    $name=$_POST["name"];
    $image=$_POST["image"];
    $price_current=$_POST["price_current"];
    $sl=$_POST["sl"];
    //Tạo mảng con
    $sp = array($id,$name,$image,$price_current,$sl);
    //Add vào giỏ hàng
    if(!isset($_SESSION["cart"])) $_SESSION["cart"]=array();
    array_push($_SESSION["cart"] ,$sp);
    header("location:cart.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Shopee Việt Nam | Mua Và Bán Trên Ứng Dụng Di Động Hoặc Website</title>
    <link rel="stylesheet" href="./css/chitietsp.css">
</head>
<body>
    <div class="app">
        <header class="header">
            <div class="grid">
                <nav class="navbar">
                   <ul class="ul_navbar">
                        <li class="li_navbar ngancach">
                           <a href="https://shopee.vn/seller/login?next=https%3A%2F%2Fbanhang.shopee.vn%2F" class="navbar_link">
                           Kênh Người Bán
                           </a>
                       </li>
                        <!-- <li class="li_navbar ngancach"> 
                           <a href="https://shopee.vn/seller/signup" class="navbar_link">
                           Trở Thành Người Bán Shopee
                           </a>
                       </li> -->
                        <li class="li_navbar ngancach hien_qr">
                           <a href="https://shopee.vn/web" class="navbar_link">
                           Tải Ứng Dụng
                           </a>
                           <div class="qr">
                               <img src="../images/qr1.png" alt="" class="img_qr">
                           </div>
                        </li>
   
                        <li class="li_navbar">
                           <span class="nopointer">Kết Nối</span>
                             <a href="https://www.facebook.com/ShopeeVN" class="navbar_link">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="img_nb" viewBox="0 0 16 16">
                                   <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                 </svg>
                             </a>
                           <a href="https://www.facebook.com/ShopeeVN" class="navbar_link">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="img_nb" viewBox="0 0 16 16">
                                   <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                               </svg>
                           </a>
                        </li>
   
                   </ul>
       
                   <ul class="ul_navbar">
                       <li class="li_navbar hien_thongbao ">
                           <a href="" class="navbar_link">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="i" viewBox="0 0 16 16">
                                   <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                               </svg>
                               Thông Báo
                           </a>
                           <div class="thongbao">
                               <!-- <img src="../images/thongbao.png" alt="" class="img_thongbao" width="100%"> -->
                               <header class="h_tb">
                                   <h3>THÔNG BÁO MỚI NHẬN</h3>
                               </header>
                               <ul class="ul_tb">
                                 <li class="li_tb">
                                   <a href="" class="a_tb">
                                       <img src="../images/tb1.png" alt="" class="img_tb">
                                       <div class="info">
                                           <span class="name">SHOP MỚI LÊN SÀN TUNG MÃ XỊN</span>
                                           <span class="tt">Voucher giảm 40.000đ đơn 129.000đ </span>
                                       </div>
                                   </a>
                                 </li>
                                 <li class="li_tb">
                                   <a href="" class="a_tb">
                                       <img src="../images/tb2.png" alt="" class="img_tb">
                                       <div class="info">
                                           <span class="name">HÔM NAY FREESHIP TỚI 300.000Đ</span>
                                           <span class="tt">Hàng công nghệ ,thực phẩm,thời trang Deal sốc mỗi ngày</span>
                                       </div>
                                   </a>
                                 </li>
                                 <li class="li_tb">
                                   <a href="" class="a_tb">
                                       <img src="../images/tb3.png" alt=""class="img_tb">
                                       <div class="info">
                                           <span class="name">MUA ĐƠN NÀO FREESHIP ĐƠN ĐÓ</span>
                                           <span class="tt">Voucher giảm đến 1 Triệu đơn 3 Triệu</span>
                                       </div>
                                   </a>
                                 </li>
                                 <li class="li_tb">
                                   <a href="" class="a_tb">
                                       <img src="../images/tb4.png" alt="" class="img_tb">
                                       <div class="info">
                                           <span class="name">CỨ GỌI LÀ FREESHIP MÃI THÔI</span>
                                           <span class="tt">Nhận gấp đôi ưu đãi vận chuyển đến 300.000Đ</span>
                                       </div>
                                   </a>
                                 </li>
                                 <li class="li_tb">
                                   <a href="" class="a_tb">
                                       <img src="../images/tb3.png" alt="" class="img_tb">
                                       <div class="info">
                                           <span class="name">SIÊU SALE VẪN CÒN BẠN ƠI</span>
                                           <span class="tt">Ưu đãi to giá mua cực nhỏ</span>
                                       </div>
                                   </a>
                                 </li>
                               </ul>
                               <footer class="ft_tb">
                                   <a href="">Xem tất cả</a>
                               </footer>
                           </div>
                       </li>
   
                       <li class="li_navbar">
                           <a href="" class="navbar_link">
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon--circle" viewBox="0 0 16 16">
                                   <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                   <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                 </svg>
                               Hỗ Trợ</a>
                       </li>
   
                       <li class="li_navbar language">
                           <a href="" class="navbar_link">
                               <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.00065 14.6667C11.6825 14.6667 14.6673 11.6819 14.6673 8.00004C14.6673 4.31814 11.6825 1.33337 8.00065 1.33337C4.31875 1.33337 1.33398 4.31814 1.33398 8.00004C1.33398 11.6819 4.31875 14.6667 8.00065 14.6667Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5.33464 8.00004C5.33464 11.6819 6.52854 14.6667 8.0013 14.6667C9.47406 14.6667 10.668 11.6819 10.668 8.00004C10.668 4.31814 9.47406 1.33337 8.0013 1.33337C6.52854 1.33337 5.33464 4.31814 5.33464 8.00004Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path><path d="M1.33398 8H14.6673" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                               Tiếng Việt
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-down" viewBox="0 0 16 16">
                                   <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                 </svg>
                           </a>
                           <ul class="ul_language">
                               <li class="li_language">
                                   <a href="" class="link_language">Tiếng Việt</a>
                               </li>
                               <li class="li_language">
                                   <a href="" class="link_language">English </a>
                               </li>
                           </ul>
                       </li>
   
                       <!-- <li class="li_navbar ngancach"><a href="/shoppee/dangki.html" class="navbar_link">Đăng Kí</a></li> -->
                       <!-- <li class="li_navbar"><a href="/shoppee/dangnhap.html" class="navbar_link">Đăng Nhập</a></li> -->
                       
                       </li>
                       <li class="li_navbar user">
                          <a href="" style="color: #fff;">
                           <img src="../images/avatar.png" alt="" class="img_user">
                           <span>Đinh Cường</span>
                          </a>
   
                           <ul class="ul_user">
                               <li class="li_user">
                                   <a href="" class="link_user">Tài Khoản Của Tôi</a>
                               </li>
                               <li class="li_user">
                                   <a href="" class="link_user">Đơn Mua </a>
                               </li>
                               <li class="li_user">
                                   <a href="index.php" class="link_user">Đăng Xuất</a>
                               </li>
                               
                           </ul>
                       </li>
                   </ul>
                </nav>
                 
                <div class="row header_with_search">
                   <div class="col-1">
                    <a href="" class="" >
                        <svg enable-background="new 0 0 48 48" viewBox="0 0 48 48" x="0" y="0" class="logo "><g fill="#fff" fill-rule="evenodd" transform="translate(0 -.098)"><path d="M44.4,11.5C44.4,11.5,44.4,11.5,44.4,11.5l-9.9,0C34.3,5.1,29.7,0,24,0S13.7,5.1,13.5,11.5H3.6v0c-0.5,0-0.9,0.4-0.9,0.9c0,0,0,0,0,0.1h0l1.4,30.9c0,0.1,0,0.2,0,0.3c0,0,0,0,0,0.1l0,0.1l0,0c0.2,2.2,1.8,3.9,3.9,4l0,0h31.4c0,0,0,0,0,0c0,0,0,0,0,0h0.1l0,0c2.2-0.1,3.9-1.8,4.1-4l0,0l0,0c0,0,0,0,0-0.1c0-0.1,0-0.1,0-0.2l1.5-31h0c0,0,0,0,0,0C45.3,11.9,44.9,11.5,44.4,11.5z M24,2.8c4.1,0,7.5,3.9,7.6,8.7H16.4C16.5,6.7,19.9,2.8,24,2.8z M31.9,35.8c-0.3,2.3-1.7,4.2-3.9,5.1c-1.2,0.5-2.8,0.8-4.1,0.7c-2-0.1-3.9-0.6-5.6-1.4c-0.6-0.3-1.6-1-2.3-1.5c-0.2-0.1-0.2-0.3-0.1-0.5c0.2-0.2,0.8-1.2,0.9-1.3c0.1-0.2,0.4-0.2,0.6-0.1c0,0,0.2,0.2,0.3,0.2c1.7,1.3,3.8,2.3,6.2,2.4c3,0,5.2-1.4,5.6-3.5c0.4-2.3-1.4-4.3-4.9-5.4c-1.1-0.3-3.9-1.5-4.5-1.8c-2.5-1.4-3.6-3.3-3.4-5.6c0.2-3.2,3.2-5.6,7-5.6c1.8,0,3.5,0.4,5,1c0.6,0.2,1.6,0.8,2,1.1c0.3,0.2,0.2,0.4,0.1,0.6c-0.2,0.2-0.6,0.9-0.8,1.2c-0.1,0.2-0.3,0.2-0.5,0.1c-1.9-1.3-3.9-1.7-5.7-1.8c-2.6,0.1-4.6,1.6-4.7,3.7c0,1.9,1.4,3.3,4.5,4.3C29.9,29.6,32.3,32,31.9,35.8z"></path></g></svg>
                    </a>
                   </div>
                   <div class="col-1">
                    <a  href="http://127.0.0.1:5500/web/demo.html">
                        <svg viewBox="0 0 220 44" class="logo1"><g fill="#fff" fill-rule="evenodd" transform="translate(0 -.098)"><path d="M195.78 30.899a10.49 10.49 0 0 1-6.81 2.484c-5.732 0-10.378-4.53-10.378-10.12 0-5.59 4.646-10.12 10.378-10.12 2.606 0 4.988.937 6.81 2.484.023-1.13.882-1.942 1.938-1.942 1.07 0 1.937.834 1.937 1.989v15.73c0 1.154-.868 1.98-1.937 1.98-1.07 0-1.938-.826-1.938-1.98zm-.062-7.643c0-3.588-3.024-6.497-6.755-6.497-3.73 0-6.754 2.91-6.754 6.497 0 3.588 3.024 6.498 6.754 6.498 3.73 0 6.755-2.91 6.755-6.498zM202.9 25.388V3.558c0-1.07.855-1.938 1.911-1.938s1.912.867 1.912 1.938v22.069c0 .043-.002.087-.004.13-.018 2.461.369 3.293 2.029 3.768 1.016.291 1.553 1.396 1.266 2.426-.237.854-.77 1.377-1.605 1.377h-.18c-.171 0-.347-.024-.52-.073-2.735-.783-4.904-2.78-4.81-7.867zM212.266 25.535V3.558c0-1.07.856-1.938 1.912-1.938s1.912.867 1.912 1.938V25.825c0 .082-.005.163-.015.242-.06 2.212.146 2.858 2.325 3.31 1.034.215 1.632 1.26 1.42 2.309-.186.916-.914 1.527-1.803 1.527-.127 0-.256-.013-.386-.04-2.882-.599-5.553-2.131-5.365-7.638zM97.886 24.307c.095.561.266 1.256.563 2.09 1.317 3.309 5.375 3.3 5.986 3.309 1.753.025 3.396-.331 5.011-1.223.906-.5 1.985-.412 2.556.405.572.818.395 2.028-.723 2.71-2.208 1.348-4.574 1.758-7.01 1.708-3.798-.078-7.4-1.591-9.01-5.204-.733-1.644-1.158-3.561-1.027-5.376.058-2.086.844-3.867 1.047-4.334.928-2.127 2.557-3.814 4.725-4.702 2.646-1.082 6.008-.916 8.53.43 2.936 1.566 4.571 5.136 4.41 8.384-.049.975-.799 1.803-1.817 1.803zm.412-3.333h10.906c-.86-4.592-5.845-4.37-5.845-4.37-2.52.098-4.207 1.555-5.061 4.37zM119.618 24.354c.095.561.266 1.257.563 2.09 1.318 3.31 5.376 3.3 5.986 3.31 1.753.024 3.396-.332 5.012-1.223.905-.5 1.984-.413 2.556.405.571.817.394 2.027-.723 2.71-2.209 1.347-4.574 1.758-7.011 1.707-3.797-.077-7.4-1.591-9.01-5.204-.732-1.644-1.158-3.56-1.026-5.376.058-2.085.843-3.867 1.047-4.333.928-2.127 2.557-3.815 4.725-4.702 2.645-1.083 6.007-.916 8.53.43 2.936 1.565 4.57 5.136 4.409 8.383-.049.976-.798 1.803-1.816 1.803zm.412-3.333h10.907c-.86-4.592-5.846-4.37-5.846-4.37-2.52.099-4.206 1.555-5.06 4.37zM74.109 30.871v11.367c0 2.34-3.632 2.337-3.632 0V23.806a10.064 10.064 0 0 1 0-1.329v-7.575c0-2.34 3.632-2.337 3.632 0v.51a10.537 10.537 0 0 1 6.768-2.434c5.756 0 10.422 4.55 10.422 10.164 0 5.613-4.666 10.164-10.422 10.164-2.584 0-4.947-.917-6.768-2.435zm0-7.207c.28 3.356 3.2 5.997 6.762 5.997 3.746 0 6.784-2.922 6.784-6.526 0-3.604-3.038-6.526-6.784-6.526-3.562 0-6.483 2.64-6.762 5.997zM57.09 33.306c-5.757 0-10.423-4.55-10.423-10.164s4.666-10.164 10.422-10.164 10.422 4.55 10.422 10.164c0 5.613-4.666 10.164-10.422 10.164zm-.007-3.645c3.747 0 6.784-2.922 6.784-6.526 0-3.604-3.037-6.526-6.784-6.526s-6.784 2.922-6.784 6.526c0 3.604 3.037 6.526 6.784 6.526zM28.69 15.026V2.111c0-2.337-3.631-2.34-3.631 0v29.471c0 2.337 3.631 2.341 3.631 0v-9.695c.015.364.018-.522.273-1.22.953-3.151 3.823-3.751 5.115-3.77 3.696 0 5.652 1.803 5.868 5.408V31.582c0 2.337 3.627 2.341 3.627 0v-6.126c0-1.753.106-3.676 0-4.789-.584-6.843-9.5-9.68-14.455-5.979a9.572 9.572 0 0 0-.428.338zM4.294 2.62c-2.156 1.909-3.15 5.385-2.369 8.155.678 2.4 2.66 4.27 4.803 5.323 2.222 1.09 4.676 1.673 6.564 2.505 1.32.59 2.456 1.153 3.595 2.305 1.138 1.152 1.62 2.586 1.587 3.65-.033 1.085-.441 2.182-1.023 2.869-1.487 1.755-3.889 2.414-6.106 2.303-1.572-.078-3.29-.422-4.692-1.016-1.42-.601-2.671-1.582-3.921-2.438-.807-.553-1.99-.282-2.526.631-.468.811-.098 1.92.693 2.505 2.376 1.757 4.89 3.1 7.808 3.631 2.918.532 5.463.41 8.09-.741 2.462-1.08 4.468-3.198 5.07-5.862.627-2.775-.09-5.41-1.923-7.58-2.21-2.618-5.47-3.626-8.54-4.733a24.208 24.208 0 0 1-3.295-1.423c-1.908-.973-2.883-2.363-2.75-4.528.158-2.578 2.278-3.913 4.906-4.266 2.628-.353 5.337.53 7.25 1.864 1.833 1.194 3.93-1.64 1.833-3.136C15.15-.207 8.288-.914 4.294 2.621z"></path><path d="M171.002 3.338c-1.545 4.329-5.841 7.27-10.7 7.186-4.8-.084-8.954-3.103-10.394-7.412-.33-.983-1.407-1.519-2.408-1.197a1.865 1.865 0 0 0-1.217 2.364c1.946 5.823 7.526 9.879 13.954 9.991 6.505.114 12.277-3.84 14.365-9.69a1.866 1.866 0 0 0-1.17-2.39c-.993-.342-2.082.171-2.43 1.148z" fill-rule="nonzero"></path><path d="M173.191 1.8a1.98 1.98 0 0 1 1.98 1.98v27.546a1.98 1.98 0 1 1-3.96 0V3.78a1.98 1.98 0 0 1 1.98-1.98zM147.807 1.8a1.98 1.98 0 0 1 1.98 1.98v27.546a1.98 1.98 0 1 1-3.96 0V3.78a1.98 1.98 0 0 1 1.98-1.98z"></path><circle cx="173.101" cy="3.691" r="2.07"></circle><circle cx="147.897" cy="3.691" r="2.07"></circle></g></svg>
                      </a>
                   </div>
                   <div class="col-3"></div>
                   <div class="col-5">
                      <div class="search">
                        <input type="text" class="input_search" placeholder="Tìm trong Shopee Mall">
                        <a class=" btn_search" href="">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="search_icon" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                           </svg>
                        </a>  
                      </div>
                   </div>
                   <div class="col-1"></div>
                   <div class="col-1 cart">
                       <a  href="#">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="#fff" class="bi-cart" viewBox="0 0 16 16">
                               <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                           </svg>
                       </a>
                       <div class="cart_sp">
                           <img src="../images/spt.png" alt="">
                           <p>Chưa có sản phẩm</p>
                       </div>
                   </div>
                </div>
            </div>   
        </header>


        <div class="content">
            <div class="grid">
                <div class="row ">
                    <div class="col-5">
                        <div class="product_item">
                            <div class="product_image_1">
                                <img src=admin/<?=$sanpham['image'] ?> alt="" class="img_sp1">
                            </div>
                            <div class="product_image_2">
                                <div class="row gird_row">
                                    <div class="gird_col_3 hover act">
                                    <img src=admin/<?=$sanpham['image'] ?> alt="" class="img_sp2_1">
                                    </div>
                                    <div class="gird_col_3 hover">
                                        <img src="../images/ct1.jpg" alt="" class="img_sp2">
                                    </div>
                                    <div class="gird_col_3 hover">
                                        <img src="../images/ct2.jpg" alt="" class="img_sp2">
                                    </div>
                                    <div class="gird_col_3 hover">
                                        <img src="../images/ct4.jpg" alt="" class="img_sp2">
                                    </div>
                                    <div class="gird_col_3 hover">
                                    <img src="../images/ct3.jpg" alt="" class="img_sp2">
                                    </div>
                                </div>
                            </div>
                            <div class="product_icon">
                                <div class="row" >
                                    <div class="col-6" >
                                        <div class="share">
                                            <p>Chia sẻ :</p>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0053ff" class="icon" viewBox="0 0 16 16">
                                                    <path d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.639.639 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.639.639 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76zm5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z"/>
                                                </svg>
                                            </a>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0046ab" class="icon" viewBox="0 0 16 16">
                                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                                </svg>
                                            </a>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="icon" viewBox="0 0 16 16">
                                                    <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0z"/>
                                                </svg>
                                            </a>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#00b2ff" class="icon" viewBox="0 0 16 16">
                                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                                </svg>
                                            </a>
                                            
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="like">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi-heart" viewBox="0 0 16 16">
                                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                              </svg>
                                              Đã thích ( 9,9 k)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                    <div class="headersp">
                    <div class="name_sp" ><?=$sanpham['name'] ?></div>
                            <div class="row ">
                               <div class="col-10">
                                 <div class="ul_navbar">
                                    <div class="li_nav ngancach1">
                                        <img src="../images/ct5.png" class="img_ct">
                                    </div>
                                    <div class="li_nav ngancach1">
                                        <img src="../images/ct6.png" class="img_ct">
                                    </div>
                                    <div class="li_nav ">
                                        <span class="sell"><?=$sanpham['sell'] ?>k Đã Bán</span>
                                    </div>
                                 </div>
                               </div>
                               <div class="col-2">
                                    <a href="" style="color: #999;">Tố cáo</a>
                               </div>
                            </div>
                        </div>
                        <div class="contentsp">
                            <div class="product_item_price">
                                <span class="price_old"><?=$sanpham['price_old'] ?>.000.000đ</span>
                                <span class="price_current"><?=$sanpham['price_current'] ?>.000.000đ</span>
                                <span class="sale_off"><?=$sanpham['sale'] ?>% GIẢM</span>
                            </div>

                            <div class="row content_1">
                                <div class="col-2">
                                    <span>Bảo Hiểm</span>
                                </div>
                                <div class="col-4 bh">
                                    <span>Bảo hiểm thiết bị di động</span>
                                    <span class="new">Mới</span>
                                </div>
                                <div class="col-3">
                                    <a href="">
                                        <span>Tìm hiểu thêm</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row content_1">
                                <div class="col-2">
                                    <span>Vận chuyển</span>
                                </div>
                                <div class="col-4 bh">
                                    <img src="../images/freeship.png" alt="" style="width: 10%;margin-right: 5px;">
                                    <span>Miễn phí vận chuyển</span>
                                </div>
                                <div class="col"></div>
                                <div>
                                    <img src="../images/vt.png" alt="" class="img_vt">
                                </div>
                            </div>
                            <!-- <div class="row content1">
                                <div class="col-2">
                                    <p style="margin:5px 0 0 13px;">Màu Sắc</p>
                                </div>
                                <div class="col-2 gird_col_2">
                                    <div class="color_sp">
                                        <img src="../images/ct4.jpg" alt="" class="img_color">
                                        <span>Deep Purple</span>
                                    </div>
                                </div>
                                <div class="col-2 gird_col_2">
                                    <div class="color_sp">
                                        <img src="../images/ct1.jpg" alt="" class="img_color">
                                        <span>Gold</span>
                                    </div>
                                </div>
                                <div class="col-2 gird_col_2">
                                    <div class="color_sp">
                                        <img src="../images/ct2.jpg" alt="" class="img_color">
                                        <span>Space Blue</span>
                                    </div>
                                </div>
                                <div class="col-2 gird_col_2">
                                    <div class="color_sp_1">
                                        <img src=admin/ ?=$sanpham['image'] ?> alt="" class="img_color">
                                        <span>Space Black</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#fff" class="tick" viewBox="0 0 16 16">
                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                        </svg>
                                    </div>
                                </div> -->
                            </div>

                            <div class="row content_1">
                                <div class="col-4 ">
                                    <form action="chitietsp.php" method="post" >
                                        <input type="hidden" name="id" value="<?=$sanpham['id'] ?>">
                                        <input type="hidden" name="name" value="<?=$sanpham['name'] ?>">
                                        <input type="hidden" name="image" value="<?=$sanpham['image'] ?>">
                                        <input type="hidden" name="price_current" value="<?=$sanpham['price_current'] ?>">
                                        <div class="soluong">
                                            <span>Số lượng </span>
                                            <input class="sl" type="number" name="sl" min="1" value="1" max="10">
                                        </div>
                                        <div class="tt">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#d0011b" class="cart-plus" viewBox="0 0 16 16">
                                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                        <input type="submit" class=" btn_content1" name="add" value = "Thêm vào giỏ hàng">
                                        </div>                                      
                                    </form>
                                </div>
                                <div class="col-4">
                                    <form action="addtocart.php" method="post" >
                                        <input type="hidden" name="id" value="1">
                                        <input type="hidden" name="name" value="Iphone 14 Promax">
                                        <input type="hidden" name="image" value="admin/uploads/shop_4.jpg">
                                        <input type="hidden" name="price_current" value="13">
                                        <div class="tt">
                                        <input type="submit" class=" btn_content_1" name="dathang" value = "Mua Ngay">
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="row content_1">
                                <div class="ft_sp">
                                <img src="../images/c6_2.png" alt="">
                                <img src="../images/c6_3.png" alt="">
                                <img src="../images/c6_4.png" alt="">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
         </div>
        <footer class="footer">
            <div class="end">
                <div class="row row_e">
                    <div class="col col_e">
                        <ul class="ul_e">
                            <li class="li_e">
                                <b class="b_e">CHĂM SÓC KHÁCH HÀNG</b>
                               <a href="" class="a_e">
                                <p class="p_e1" style="margin-top: 10px;">Trung Tâm Trợ Giúp</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Shoppe Blog</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Shoppe Mall</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Hướng Dẫn Mua Hàng</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Hướng Dẫn Bán Hàng</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Thanh Toán</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Shopee Xu</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Vận Chuyển</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Trả Hàng & Hoàn Tiền</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Chăm Sóc Khách Hàng</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Chính Sách Bảo Hành</p>
                               </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col col_e">
                        <ul class="ul_e">
                            <li class="li_e">
                              <b class="b_e">VỀ SHOPEE</b>
                               <a href="" class="a_e">
                                <p class="p_e1" style="margin-top: 10px;">Giới Thiệu Về Shopee Việt Nam</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Tuyển Dụng</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Điều Khoản Shopee</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Chính Sách Bảo Mật</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Chính Hãng</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Kênh Người Bán</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Flash Sales</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Chương Trình Tiếp Thị Liên Kết Shopee</p>
                               </a>
                               <a href="" class="a_e">
                                <p class="p_e">Liên Hệ Với Truyền Thông</p>
                               </a>
                            </li>
                        </ul>
                    </div>


                    <div class="col col_e">
                        <ul class="ul_e">
                            <li class="li_e">
                                <b class="b_e">THANH TOÁN</b>
                                <img src="../images/e1.png" alt=""  class="img_e">
                            </li>
                            <li class="li_e">
                                <b class="b_e">ĐƠN VỊ VẬN CHUYỂN</b>
                                <img src="../images/e2.png" alt=""  class="img_e">
                            </li>
                        </ul>
                    </div>

                    <div class="col col_e">
                        <ul class="ul_e">
                            <li class="li_e">
                               <b class="b_e">THEO DÕI CHÚNG TÔI TRÊN</b>
                            </li>
                            <li class="li_e_1">
                                <a href="https://www.facebook.com/ShopeeVN" class="a_e" >
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"class="" fill="currentColor" viewBox="0 0 16 16 ">
                                     <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                   </svg>
                                   FaceBook
                               </a>
                             </li>
                             <li class="li_e_1">
                                <a href="https://www.facebook.com/ShopeeVN" class="a_e" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-i" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                    </svg>
                                   Instagram
                               </a>
                             </li>
                             <li class="li_e_1">
                                <a href="https://www.facebook.com/ShopeeVN" class="a_e" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="icon-" viewBox="0 0 16 16">
                                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                      </svg>
                                   Linkedin
                               </a>
                             </li>
                        </ul>
                    </div>

                    <div class="col col_e">
                        <ul class="ul_e">
                            <li class="li_e">
                                <b class="b_e">TẢI ỨNG DỤNG TRÊN SHOPEE NGAY THÔI</b>
                                <a href="">
                                    <img src="../images/e3.png" alt="" class="img_e" >
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
         
    </div>
</body>
</html>