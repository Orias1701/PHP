<?php
require_once 'libs/students.php';

$id = $_GET['id'] ?? 0;
$student = get_student($id);

if (!$student) {
    die("Không tìm thấy sinh viên");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hoten = $_POST['hoten'] ?? '';
    $gioitinh = $_POST['gioitinh'] ?? '';
    $ngaysinh = $_POST['ngaysinh'] ?? '';
    edit_student($id, $hoten, $gioitinh, $ngaysinh);
    header("Location: students_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sửa sinh viên</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Sửa sinh viên</h2>
    <form method="post">
        <div class="form-group">
            <label class="form-label">Họ tên</label>
            <input type="text" name="hoten" value="<?= $student['hoten'] ?>" class="form-input">
        </div>
        <div class="form-group">
            <label class="form-label">Giới tính</label>
            <select name="gioitinh" class="form-select">
                <option value="Nam" <?= $student['gioitinh']=='Nam'?'selected':'' ?>>Nam</option>
                <option value="Nữ" <?= $student['gioitinh']=='Nữ'?'selected':'' ?>>Nữ</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Ngày sinh</label>
            <input type="date" name="ngaysinh" value="<?= $student['ngaysinh'] ?>" class="form-input">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="students_list.php" class="btn">Quay lại</a>
    </form>
</div>
</body>
</html>
