<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form Nhập Thông Tin Sách</title>
</head>
<body>
    <h2>Nhập Thông Tin Sách</h2>

    <form action="">
        <label>Tên sách: <input type="text" name="ten_sach"></label><br><br>
        <label>Tác giả: <input type="text" name="tac_gia"></label><br><br>
        <label>Nhà xuất bản: <input type="text" name="nxb"></label><br><br>
        <label>Năm xuất bản: <input type="number" name="nam"></label><br><br>

        <!-- 2 nút gửi, mỗi nút có method riêng -->
        <button type="submit" formmethod="get">GET</button>
        <button type="submit" formmethod="post">POST</button>
    </form>

    <hr>

    <?php
    if (!empty($_GET)) {
        echo "<h3>Kết quả từ GET:</h3>";
        echo "Tên sách: " . htmlspecialchars($_GET['ten_sach'] ?? '') . "<br>";
        echo "Tác giả: " . htmlspecialchars($_GET['tac_gia'] ?? '') . "<br>";
        echo "Nhà xuất bản: " . htmlspecialchars($_GET['nxb'] ?? '') . "<br>";
        echo "Năm xuất bản: " . htmlspecialchars($_GET['nam'] ?? '') . "<br>";
    }

    if (!empty($_POST)) {
        echo "<h3>Kết quả từ POST:</h3>";
        echo "Tên sách: " . htmlspecialchars($_POST['ten_sach'] ?? '') . "<br>";
        echo "Tác giả: " . htmlspecialchars($_POST['tac_gia'] ?? '') . "<br>";
        echo "Nhà xuất bản: " . htmlspecialchars($_POST['nxb'] ?? '') . "<br>";
        echo "Năm xuất bản: " . htmlspecialchars($_POST['nam'] ?? '') . "<br>";
    }
    ?>
</body>
</html>
