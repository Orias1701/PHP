<?php
function ensure_tables($pdo) {
    // Kiểm tra bảng employees (nếu thiếu, coi như chưa có schema)
    try {
        $pdo->query("SELECT 1 FROM employees LIMIT 1");
    } catch (Exception $e) {
        // Nếu chưa có thì tạo lại tất cả
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
    }
}
?>