<?php
require_once "../config/pdo_config.php";

$pdo = connect_db();

$msg = "";
if (isset($_POST['create'])) {
    try {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS departments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL UNIQUE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS roles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL UNIQUE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS employees (
                id INT AUTO_INCREMENT PRIMARY KEY,
                first VARCHAR(100) NOT NULL,
                last VARCHAR(100) NOT NULL,
                department_id INT,
                role_id INT,
                FOREIGN KEY (department_id) REFERENCES departments(id) 
                    ON DELETE SET NULL ON UPDATE CASCADE,
                FOREIGN KEY (role_id) REFERENCES roles(id) 
                    ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
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
  <title>Quản lý Bảng</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    .msg { margin: 15px 0; font-weight: bold; }
    .actions { display: flex; gap: 15px; }
    button { padding: 10px 20px; font-size: 14px; cursor: pointer; }
  </style>
  <script>
    function confirmDrop() {
      return confirm("⚠️ Bạn có chắc chắn muốn XÓA 3 bảng không?\nDữ liệu sẽ mất vĩnh viễn!");
    }
  </script>
</head>
<body>
  <h2>Quản lý Bảng (Departments, Roles, Employees)</h2>

  <?php if ($msg): ?>
    <div class="msg"><?= $msg ?></div>
  <?php endif; ?>

  <form method="post" class="actions">
    <button type="submit" name="create">Tạo Bảng</button>
    <button type="submit" name="drop" onclick="return confirmDrop()">Xóa Bảng</button>
  </form>
</body>
</html>
