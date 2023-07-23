<?php
include "partials/constants.php";

$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "DELETE FROM admin WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
if ($del) {
    $_SESSION['massege'] = "<span style='color: #2ed573'>admin is deleted sccessfully</span>";
    header("location:manage-admin.php");
    exit;
} else {
    $_SESSION['massege'] = "<span style='color: #2ed573'>admin faild deleted</span>";
    header("location:manage-admin.php");
}