<?php
include 'config.php';

$sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES
('John', 'Doe', 'john@example.com'),
('Jane', 'Smith', 'jane@example.com'),
('James', 'Johnson', 'james@example.com'),
('Emily', 'Brown', 'emily@example.com'),
('Michael', 'Davis', 'michael@example.com')";
$conn->query($sql);

$conn->close();

header("Location: list_data.php");
exit;
?>
