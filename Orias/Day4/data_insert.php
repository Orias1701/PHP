<?php
include 'config.php';

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES 
('John', 'Doe', 'john@example.com'),
('Jane', 'Smith', 'jane@example.com'),
('James', 'Johnson', 'james@example.com'),
('Emily', 'Brown', 'emily@example.com'),
('Michael', 'Davis', 'michael@example.com')";

if ($conn->query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
include 'list_data.php';
?>
