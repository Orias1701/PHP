<?php
require_once 'libs/students.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hoten = $_POST['hoten'] ?? '';
    $gioitinh = $_POST['gioitinh'] ?? '';
    $ngaysinh = $_POST['ngaysinh'] ?? '';
    add_student($hoten, $gioitinh, $ngaysinh);
    header("Location: students_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thêm sinh viên</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Thêm sinh viên</h2>
    <form method="post">
        <div class="form-group">
            <label class="form-label">Họ tên</label>
            <input type="text" name="hoten" class="form-input">
        </div>
        <div class="form-group">
            <label class="form-label">Giới tính</label>
            <select name="gioitinh" class="form-select">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Ngày sinh</label>
            <input type="date" name="ngaysinh" class="form-input">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="students_list.php" class="btn">Quay lại</a>
    </form>
</div>
</body>
</html>
