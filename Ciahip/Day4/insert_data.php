<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "b5_mydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES
('John', 'Doe', 'john@example.com'),
('Jane', 'Smith', 'jane@example.com'),
('James', 'Johnson', 'james@example.com'),
('Emily', 'Brown', 'emily@example.com'),
('Michael', 'Davis', 'michael@example.com')";

if ($conn->query($sql) === TRUE) {
    echo "Thêm dữ liệu thành công";
} else {
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>
