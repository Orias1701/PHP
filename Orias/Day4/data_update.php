<?php
$servername = "localhost";
$username = "root";
$password = "170105";
$dbname = "b5_mydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE MyGuests SET firstname='Jane' WHERE firstname='James'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully<br>";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

// Hiển thị lại danh sách
include 'list_data.php';
?>
