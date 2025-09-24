<?php
require_once "auth.php";
require_once "createtable.php";
require_once "../config/pdo_config.php";
$pdo = connect_db();

$msg = "";
if (isset($_POST['create'])) {
    try {
        ensure_tables($pdo);
        $msg = "✅ Các bảng đã được tạo thành công!";
    } catch (PDOException $e) {
        $msg = "❌ Lỗi khi tạo bảng: " . $e->getMessage();
    }
}

if (isset($_POST['drop'])) {
    try {
        $pdo->exec("DROP TABLE IF EXISTS employees;");
        $pdo->exec("DROP TABLE IF EXISTS departments;");
        $pdo->exec("DROP TABLE IF EXISTS roles;");
        $msg = "✅ Đã xóa 3 bảng: employees, departments, roles thành công!";
    } catch (PDOException $e) {
        $msg = "❌ Lỗi khi xóa bảng: " . $e->getMessage();
    }
}
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Trang chủ - Quản lý Nhân sự</title>
  <link rel="stylesheet" href="../assets/style.css">
  <script>
    function confirmDrop() {
      return confirm("⚠️ Bạn có chắc chắn muốn XÓA 3 bảng không?\nDữ liệu sẽ mất vĩnh viễn!");
    }
  </script>
</head>
<body>
  <?php include "navbar.php"; ?>

  <div style="text-align:center; margin-top:30px;">
    <h1>Chào mừng đến hệ thống Quản lý Nhân sự</h1>
    <p>Chọn menu ở trên để quản lý Departments, Roles hoặc Employees.</p>

    <?php if ($msg): ?>
      <div class="msg"><?= $msg ?></div>
    <?php endif; ?>

    <form method="post" style="margin-top:20px;">
      <button type="submit" name="create">Tạo Bảng</button>
      <button type="submit" name="drop" onclick="return confirmDrop()">Xóa Bảng</button>
    </form>
  </div>
</body>
</html>
