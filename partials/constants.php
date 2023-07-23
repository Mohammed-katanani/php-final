<?php
ob_start();

session_start();
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'finalPhpProject');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS , DB_NAME);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    echo 'Connection failed: ' . mysqli_connect_error();
    exit();
}
