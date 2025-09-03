<?php
include 'config.php';

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
