<?php
session_start();

// Chặn chưa đăng nhập
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Timeout 5 phút
$timeout = 60*10;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location: login.php?expired=1");
    exit;
}
$_SESSION['last_activity'] = time();

// Hàm flash message
function set_flash($msg) {
    $_SESSION['flash'] = $msg;
}
function get_flash() {
    if (!empty($_SESSION['flash'])) {
        $m = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $m;
    }
    return "";
}
