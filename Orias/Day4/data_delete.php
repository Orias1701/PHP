<?php
$servername = "localhost";
$username = "root";
$password = "170105";
$dbname = "b5_mydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM MyGuests WHERE id=3";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully<br>";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

// Hiển thị lại danh sách
include 'list_data.php';
?>
