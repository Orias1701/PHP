<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "b5_mydb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// 1. Update Firstname James -> Jane
$sql = "UPDATE MyGuests SET firstname='Jane' WHERE firstname='James'";
if ($conn->query($sql) === TRUE) {
    echo "Cập nhật thành công<br>";
} else {
    echo "Lỗi cập nhật: " . $conn->error;
}

// 2. Delete id=3
$sql = "DELETE FROM MyGuests WHERE id=3";
if ($conn->query($sql) === TRUE) {
    echo "Xóa thành công<br>";
} else {
    echo "Lỗi xóa: " . $conn->error;
}

// Hiển thị lại danh sách sau khi cập nhật và xóa
echo "<h2 style='text-align:center;'>Danh sách nhân viên sau khi cập nhật & xóa</h2>";
$result = $conn->query("SELECT id, firstname, lastname, reg_date FROM MyGuests");

echo "<table border='1' cellspacing='0' cellpadding='8' style='margin:auto; text-align:center; border-collapse:collapse; font-family:Arial;'>";
echo "<tr style='background-color:#f2f2f2;'>
        <th>Id</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Reg_Date</th>
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
    echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
}
echo "</table>";

$conn->close();
?>
