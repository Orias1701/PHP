<?php
require_once 'libs/students.php';
$id = $_GET['id'] ?? 0;
if ($id) {
    delete_student($id);
}
header("Location: students_list.php");
exit;
