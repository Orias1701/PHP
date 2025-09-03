<?php
include 'config.php';

// Thêm menu nút thao tác
echo "
<div style='margin-bottom:15px;'>
    <form method='post'>
        <button type='submit' name='action' value='create'>Tạo bảng</button>
        <button type='submit' name='action' value='insert'>Thêm dữ liệu</button>
        <button type='submit' name='action' value='update'>Cập nhật dữ liệu</button>
        <button type='submit' name='action' value='delete'>Xóa dữ liệu</button>
    </form>
</div>
";

// Nếu nhấn nút thì chạy file tương ứng
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == 'create') {
        include 'create_table.php';
    } elseif ($action == 'insert') {
        include 'data_insert.php';
    } elseif ($action == 'update') {
        include 'data_update.php';
    } elseif ($action == 'delete') {
        include 'data_delete.php';
    }
    echo "<hr>";
}

// Hiển thị danh sách
$sql = "SELECT id, firstname, lastname, reg_date FROM MyGuests";
$result = $conn->query($sql);

echo "<h2>Danh sách nhân viên</h2>";
echo "<table border='1' cellpadding='5'>
<tr>
<th>Id</th><th>Firstname</th><th>Lastname</th><th>Reg_Date</th>
</tr>";

if ($result && $result->num_rows > 0) {
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
