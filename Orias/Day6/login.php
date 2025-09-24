<?php
session_start();
require_once "../config/pdo_config.php";

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? "";
    $pass = $_POST['password'] ?? "";

    if ($user === ADMIN_USER && $pass === ADMIN_PASS) {
        $_SESSION['logged_in'] = true;
        $_SESSION['last_activity'] = time();
        header("Location: index.php");
        exit;
    } else {
        $msg = "❌ Sai tài khoản hoặc mật khẩu";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="../assets/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f6f8fa;
      margin: 0;
      padding: 0;
      align-items: center;
      justify-content: center;
    }

    h2 {
      text-align: center;
      margin-top: 100px;
      margin-bottom: 30px;
    }

    form {
      width: fit-content;
      display: grid;
      grid-template-columns: 120px 250px;
      gap: 12px 16px;
      padding: 60px 50px;
      margin: auto;
      background: #fff;
      border: 1px solid #d0d7de;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    form label {
      text-align: right;
      font-weight: bold;
      align-self: center;
    }

    form input[type="text"],
    form input[type="password"] {
      padding: 6px 10px;
      font-size: 14px;
      border: 1px solid #d0d7de;
      border-radius: 6px;
      box-sizing: border-box;
      width: 100%;
    }

    form button {
      grid-column: 1 / span 2; /* nút chiếm cả 2 cột */
      padding: 8px 14px;
      font-size: 14px;
      border: 1px solid #d0d7de;
      border-radius: 6px;
      background: #f6f8fa;
      cursor: pointer;
      transition: background 0.2s, border-color 0.2s;
    }

    form button:hover {
      background: #eaeef2;
      border-color: #afb8c1;
    }

    form div {
      grid-column: 1 / span 2;
      font-size: 12px;
      color: #555;
      text-align: center;
    }

    .msg {
      margin-bottom: 15px;
      text-align: center;
      color: #d73a49;
      font-weight: bold;
    }

  </style>
</head>
<body>
  <h2>Đăng nhập</h2>
  <?php if ($msg): ?><div class="msg"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
  <form method="post">
    <label>Username:</label><input type="text" name="username" required>
    <label>Password:</label><input type="password" name="password" required>
    <div>*note: admin - admin</div>
    <button type="submit">Đăng nhập</button>
  </form>
</body>
</html>
