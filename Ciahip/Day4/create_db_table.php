<?php
$servername = "localhost";
$username = "root";  // user mặc định của MySQL/XAMPP
$password = "";      // nếu có mật khẩu thì điền vào
$dbname = "b5_mydb";

// Kết nối server
$conn = new mysqli($servername, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tạo CSDL
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Tạo CSDL thành công<br>";
} else {
    echo "Lỗi khi tạo CSDL: " . $conn->error;
}

// Chọn CSDL
$conn->select_db($dbname);

// Tạo bảng
$sql = "CREATE TABLE IF NOT EXISTS MyGuests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Tạo bảng MyGuests thành công";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}

$conn->close();
?>
