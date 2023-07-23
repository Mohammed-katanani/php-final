<?php
include 'partials/constants.php';
$id = $_GET['id'];
$stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
if ($res) {
    $_SESSION['massege'] = "deleted";
    header("location:manage-products.php");
} else {
    $_SESSION['massege'] = " not deleted";
    header("location:manage-products.php");
}
