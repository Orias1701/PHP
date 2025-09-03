<?php
include 'config.php';

$sql = "SELECT id, firstname, lastname, reg_date FROM MyGuests";
$result = $conn->query($sql);

echo "<h2>Danh sách nhân viên</h2>";
echo "<table border='1' cellpadding='5'>
<tr>
<th>Id</th><th>Firstname</th><th>Lastname</th><th>Reg_Date</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["id"]."</td>
            <td>".$row["firstname"]."</td>
            <td>".$row["lastname"]."</td>
            <td>".$row["reg_date"]."</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>0 results</td></tr>";
}
echo "</table>";

$conn->close();
?>
