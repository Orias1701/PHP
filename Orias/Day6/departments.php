<?php
require_once "../config/pdo_config.php";
$pdo = connect_db();

// Thêm
if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO departments (name) VALUES (:name)");
    $stmt->execute([':name' => $_POST['name']]);
    header("Location: departments.php"); exit;
}

// Sửa
if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE departments SET name=:name WHERE id=:id");
    $stmt->execute([':name' => $_POST['name'], ':id' => $_POST['id']]);
    header("Location: departments.php"); exit;
}

// Xóa
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM departments WHERE id=:id");
    $stmt->execute([':id' => $_GET['delete']]);
    header("Location: departments.php"); exit;
}

// Tìm kiếm
$where = "";
$params = [];
if (!empty($_GET['search'])) {
    $search = "%".$_GET['search']."%";
    $where = "WHERE id LIKE :s OR name LIKE :s";
    $params[':s'] = $search;
}

$sql = "SELECT * FROM departments $where ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Departments</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<h2>Departments</h2>

<!-- Tìm kiếm -->
<form method="get" style="margin-bottom:15px;">
  <input type="text" name="search" placeholder="Tìm theo ID hoặc Name"
         value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
  <button type="submit">Tìm</button>
  <a href="departments.php"><button type="button">Reset</button></a>
</form>

<button onclick="openPopup('popupAdd')">+ Thêm</button>

<table class="table-list">
<tr><th>ID</th><th>Name</th><th>Hành động</th></tr>
<?php foreach($rows as $r): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= htmlspecialchars($r['name']) ?></td>
  <td>
    <button onclick="openPopup('popupEdit<?= $r['id'] ?>')">Sửa</button>
    <button onclick="confirmDelete('?delete=<?= $r['id'] ?>')">Xóa</button>
  </td>
</tr>

<!-- Popup sửa -->
<div id="popupEdit<?= $r['id'] ?>" class="popup">
  <div class="popup-content">
    <h3>Sửa Department</h3>
    <form method="post" class="form-grid">
      <label>ID:</label>
      <input type="text" name="id" value="<?= $r['id'] ?>" readonly>
      <label>Tên:</label>
      <input type="text" name="name" value="<?= htmlspecialchars($r['name']) ?>" required>
      <div></div><button type="submit" name="update">Lưu</button>
      <div></div><button type="button" onclick="closePopup('popupEdit<?= $r['id'] ?>')">Hủy</button>
    </form>
  </div>
</div>
<?php endforeach; ?>
</table>

<!-- Popup thêm -->
<div id="popupAdd" class="popup">
  <div class="popup-content">
    <h3>Thêm Department</h3>
    <form method="post" class="form-grid">
      <label>Tên:</label><input type="text" name="name" required>
      <div></div><button type="submit" name="add">Thêm</button>
      <div></div><button type="button" onclick="closePopup('popupAdd')">Hủy</button>
    </form>
  </div>
</div>

<script src="../assets/script.js"></script>
</body>
</html>
