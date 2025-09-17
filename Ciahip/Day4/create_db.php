<?php
include 'config.php';

$sql = "CREATE DATABASE b5_mydb";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>
