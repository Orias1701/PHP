<?php
require_once "auth.php";
require_once "createtable.php";
require_once "../config/pdo_config.php";
$pdo = connect_db();
ensure_tables($pdo);

// Thêm
if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO roles (name) VALUES (:name)");
    $stmt->execute([':name' => $_POST['name']]);
    set_flash("✅ Đã thêm Role mới");
    header("Location: listroles.php"); exit;
}

// Sửa
if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE roles SET name=:name WHERE id=:id");
    $stmt->execute([':name' => $_POST['name'], ':id' => $_POST['id']]);
    set_flash("✅ Đã cập nhật Role");
    header("Location: listroles.php"); exit;
}

// Xóa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $count = $pdo->prepare("SELECT COUNT(*) FROM employees WHERE role_id=:id");
    $count->execute([':id'=>$id]);
    if ($count->fetchColumn() > 0) {
        set_flash("⚠️ Không thể xóa: vẫn còn Employee trong Role này");
    } else {
        $pdo->prepare("DELETE FROM roles WHERE id=:id")->execute([':id'=>$id]);
        set_flash("✅ Đã xóa Role");
    }
    header("Location: listroles.php"); exit;
}

// Lấy danh sách
$rows = $pdo->query("SELECT * FROM roles ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
disconnect_db();
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Roles</title><link rel="stylesheet" href="../assets/style.css"></head>
<body>
<?php include "navbar.php"; ?>
<h2>Roles</h2>

<?php if ($m = get_flash()): ?><div class="msg"><?= htmlspecialchars($m) ?></div><?php endif; ?>

<button onclick="openPopup('popupAdd')">+ Thêm</button>
<table class="table-list">
<tr><th>ID</th><th>Name</th><th>Hành động</th></tr>
<?php foreach($rows as $r): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= htmlspecialchars($r['name']) ?></td>
  <td>
    <button onclick="openEditPopup('<?= $r['id']?>','<?= htmlspecialchars($r['name'],ENT_QUOTES)?>')">Sửa</button>
    <button onclick="confirmDelete('?delete=<?= $r['id']?>')">Xóa</button>
  </td>
</tr>
<?php endforeach; ?>
</table>

<!-- Popup Add -->
<div id="popupAdd" class="popup"><div class="popup-content">
  <h3>Thêm Role</h3>
  <form method="post" class="form-grid">
    <label>Tên:</label><input type="text" name="name" required>
    <button type="submit" name="add">Thêm</button>
    <button type="button" onclick="closePopup('popupAdd')">Hủy</button>
  </form>
</div></div>

<!-- Popup Edit -->
<div id="popupEdit" class="popup"><div class="popup-content">
  <h3>Sửa Role</h3>
  <form method="post" class="form-grid">
    <label>ID:</label><input type="text" id="edit-id" name="id" readonly>
    <label>Tên:</label><input type="text" id="edit-name" name="name" required>
    <button type="submit" name="update">Lưu</button>
    <button type="button" onclick="closePopup('popupEdit')">Hủy</button>
  </form>
</div></div>

<script src="../assets/script.js"></script>
<script>
function openEditPopup(id, name) {
  document.getElementById("edit-id").value = id;
  document.getElementById("edit-name").value = name;
  openPopup("popupEdit");
}
</script>
</body>
</html>
