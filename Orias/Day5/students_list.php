<?php
require_once 'libs/students.php';
$students = get_all_students();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Danh sách sinh viên</h2>
    <a href="students_add.php" class="btn btn-success">+ Thêm sinh viên</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($students as $sv): ?>
        <tr>
            <td><?= $sv['id'] ?></td>
            <td><?= $sv['hoten'] ?></td>
            <td><?= $sv['gioitinh'] ?></td>
            <td><?= $sv['ngaysinh'] ?></td>
            <td>
                <a href="students_edit.php?id=<?= $sv['id'] ?>" class="btn btn-warning">Sửa</a>
                <a href="students_delete.php?id=<?= $sv['id'] ?>" class="btn btn-danger" onclick="return confirm('Xóa sinh viên này?');">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
