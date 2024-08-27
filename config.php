<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname="shopee";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
    // echo "ket noi thanh cong";
  }
?>