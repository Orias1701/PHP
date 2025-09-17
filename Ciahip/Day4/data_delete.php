<?php
include 'config.php';

$sql = "DELETE FROM MyGuests WHERE id=3";
$conn->query($sql);

$conn->close();

header("Location: list_data.php");
exit;
?>
