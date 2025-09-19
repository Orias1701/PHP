<?php
require_once '../config/pdo_config.php';

// Hàm kiểm tra và tạo bảng nếu chưa có
function ensure_table_exists() {
    $pdo = connect_db();
    $sql = "
        CREATE TABLE IF NOT EXISTS sinhvien (
            id INT AUTO_INCREMENT PRIMARY KEY,
            hoten VARCHAR(255) NOT NULL,
            gioitinh VARCHAR(10) NOT NULL,
            ngaysinh DATE NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ";
    $pdo->exec($sql);
}

// Lấy tất cả sinh viên
function get_all_students() {
    ensure_table_exists();
    $pdo = connect_db();
    $stmt = $pdo->query("SELECT * FROM sinhvien ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy sinh viên theo ID
function get_student($id) {
    ensure_table_exists();
    $pdo = connect_db();
    $stmt = $pdo->prepare("SELECT * FROM sinhvien WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Thêm sinh viên
function add_student($hoten, $gioitinh, $ngaysinh) {
    ensure_table_exists();
    $pdo = connect_db();
    $stmt = $pdo->prepare("INSERT INTO sinhvien (hoten, gioitinh, ngaysinh) VALUES (?, ?, ?)");
    return $stmt->execute([$hoten, $gioitinh, $ngaysinh]);
}

// Sửa sinh viên
function edit_student($id, $hoten, $gioitinh, $ngaysinh) {
    ensure_table_exists();
    $pdo = connect_db();
    $stmt = $pdo->prepare("UPDATE sinhvien SET hoten = ?, gioitinh = ?, ngaysinh = ? WHERE id = ?");
    return $stmt->execute([$hoten, $gioitinh, $ngaysinh, $id]);
}

// Xóa sinh viên
function delete_student($id) {
    ensure_table_exists();
    $pdo = connect_db();
    $stmt = $pdo->prepare("DELETE FROM sinhvien WHERE id = ?");
    return $stmt->execute([$id]);
}
?>
