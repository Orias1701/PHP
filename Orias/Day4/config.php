<?php
$servername = "sql112.infinityfree.com";
$username   = "if0_39708432";
$password   = "LongK171";
$dbname     = "if0_39708432_mydb";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
