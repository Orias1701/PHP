<?php
require_once "auth.php";
require_once "createtable.php";
require_once "../config/pdo_config.php";
$pdo = connect_db();
ensure_tables($pdo);

// Thêm
if (isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO employees (first,last,department_id,role_id)
                           VALUES (:f,:l,:d,:r)");
    $stmt->execute([
        ':f'=>$_POST['first'], ':l'=>$_POST['last'],
        ':d'=>$_POST['department_id'], ':r'=>$_POST['role_id']
    ]);
    header("Location: listemployees.php"); exit;
}

// Sửa
if (isset($_POST['update'])) {
    $stmt = $pdo->prepare("UPDATE employees SET first=:f,last=:l,department_id=:d,role_id=:r WHERE id=:id");
    $stmt->execute([
        ':f'=>$_POST['first'], ':l'=>$_POST['last'],
        ':d'=>$_POST['department_id'], ':r'=>$_POST['role_id'],
        ':id'=>$_POST['id']
    ]);
    header("Location: listemployees.php"); exit;
}

// Xóa
if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM employees WHERE id=:id")->execute([':id'=>$_GET['delete']]);
    set_flash("✅ Đã xóa Employee");
    header("Location: listemployees.php"); exit;
}

// Tìm kiếm
$where = "";
$params = [];
if (!empty($_GET['search'])) {
    $search = "%".$_GET['search']."%";
    $where = "WHERE e.id LIKE :s 
              OR e.first LIKE :s 
              OR e.last LIKE :s 
              OR d.name LIKE :s 
              OR r.name LIKE :s";
    $params[':s'] = $search;
}

$sql = "
  SELECT e.id,e.first,e.last,d.name as department,r.name as role,
         e.department_id,e.role_id
  FROM employees e
  LEFT JOIN departments d ON e.department_id=d.id
  LEFT JOIN roles r ON e.role_id=r.id
  $where
  ORDER BY e.id DESC
";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$departments = $pdo->query("SELECT * FROM departments")->fetchAll(PDO::FETCH_ASSOC);
$roles = $pdo->query("SELECT * FROM roles")->fetchAll(PDO::FETCH_ASSOC);

disconnect_db();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Employees</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<?php include "navbar.php"; ?>
<h2>Employees</h2>

<form method="get" style="margin-bottom:15px;">
  <input type="text" name="search" placeholder="Tìm kiếm"
         value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
  <button type="submit">Tìm</button>
  <a href="listemployees.php"><button type="button">Reset</button></a>
</form>

<button onclick="openPopup('popupAdd')">+ Thêm</button>

<table class="table-list">
<tr><th>ID</th><th>First</th><th>Last</th><th>Department</th><th>Role</th><th>Hành động</th></tr>
<?php foreach($rows as $r): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= htmlspecialchars($r['first']) ?></td>
  <td><?= htmlspecialchars($r['last']) ?></td>
  <td><?= htmlspecialchars($r['department']) ?></td>
  <td><?= htmlspecialchars($r['role']) ?></td>
  <td>
    <button onclick="openEditPopup(
        '<?= $r['id'] ?>',
        '<?= htmlspecialchars($r['first'], ENT_QUOTES) ?>',
        '<?= htmlspecialchars($r['last'], ENT_QUOTES) ?>',
        '<?= $r['department_id'] ?>',
        '<?= $r['role_id'] ?>'
    )">Sửa</button>
    <button onclick="confirmDelete('?delete=<?= $r['id'] ?>')">Xóa</button>
  </td>
</tr>
<?php endforeach; ?>
</table>

<!-- Popup sửa -->
<div id="popupEdit" class="popup">
  <div class="popup-content">
    <h3>Sửa Employee</h3>
    <form method="post" class="form-grid">
      <label>ID:</label>
      <input type="text" id="edit-id" name="id" readonly>

      <label>First:</label>
      <input type="text" id="edit-first" name="first" required>

      <label>Last:</label>
      <input type="text" id="edit-last" name="last" required>

      <label>Department:</label>
      <select id="edit-department" name="department_id">
        <?php foreach($departments as $d): ?>
        <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
        <?php endforeach; ?>
      </select>

      <label>Role:</label>
      <select id="edit-role" name="role_id">
        <?php foreach($roles as $role): ?>
        <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
        <?php endforeach; ?>
      </select>

      <div></div><button type="submit" name="update">Lưu</button>
      <div></div><button type="button" onclick="closePopup('popupEdit')">Hủy</button>
    </form>
  </div>
</div>

<!-- Popup thêm -->
<div id="popupAdd" class="popup">
  <div class="popup-content">
    <h3>Thêm Employee</h3>
    <form method="post" class="form-grid">
      <label>First:</label><input type="text" name="first" required>
      <label>Last:</label><input type="text" name="last" required>
      <label>Department:</label>
      <select name="department_id">
        <?php foreach($departments as $d): ?>
        <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
        <?php endforeach; ?>
      </select>
      <label>Role:</label>
      <select name="role_id">
        <?php foreach($roles as $r): ?>
        <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
        <?php endforeach; ?>
      </select>
      <div></div><button type="submit" name="add">Thêm</button>
      <div></div><button type="button" onclick="closePopup('popupAdd')">Hủy</button>
    </form>
  </div>
</div>

<script src="../assets/script.js"></script>
<script>
  function openEditPopup(id, first, last, department_id, role_id) {
    document.getElementById("edit-id").value = id;
    document.getElementById("edit-first").value = first;
    document.getElementById("edit-last").value = last;

    // set selected option
    document.getElementById("edit-department").value = department_id;
    document.getElementById("edit-role").value = role_id;

    openPopup("popupEdit");
  }
</script>
</body>
</html>
