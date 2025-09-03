<?php
include 'config.php';

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
