<?php
include 'b3.php';

$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = (float)$_POST["a"];
    $b = (float)$_POST["b"];
    $operation = $_POST["operation"];

    switch ($operation) {
        case "tong":
            $result = "Kết quả: " . tong($a, $b);
            break;
        case "hieu":
            $result = "Kết quả: " . hieu($a, $b);
            break;
        case "tich":
            $result = "Kết quả: " . tich($a, $b);
            break;
        case "thuong":
            $result = "Kết quả: " . thuong($a, $b);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Máy Tính PHP</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container">
        <h2>Máy Tính Đơn Giản</h2>
        <form method="post">
            <label>Nhập số A:</label>
            <input type="number" step="any" name="a" required>
            
            <label>Nhập số B:</label>
            <input type="number" step="any" name="b" required>
            
            <label>Chọn phép tính:</label>
            <select name="operation" required>
                <option value="tong">Cộng (+)</option>
                <option value="hieu">Trừ (-)</option>
                <option value="tich">Nhân (×)</option>
                <option value="thuong">Chia (÷)</option>
            </select>
            
            <button type="submit">Tính</button>
        </form>
        <?php if ($result !== ""): ?>
            <div class="result"><?php echo $result; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
