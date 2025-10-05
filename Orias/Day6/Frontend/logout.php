<?php
// frontend/logout.php
require_once '../backend/common.php';

session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;