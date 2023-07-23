<?php
include "partials/header.php";
include "partials/menu.php";
$id = $_GET['id'];
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$stmt = mysqli_prepare($conn, "SELECT * FROM `admin` WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if ($res->num_rows > 0) {
    if ($row = $res->fetch_assoc()) {
        $full_name = addslashes($row["full_name"]);
        $email = $row["email"];
    }
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email" value="<?php echo $email ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php
include "partials/footer.php";
if (isset($_POST['submit'])) {
    $submitted_token = $_POST['csrf_token'];

    // Validate the token
    if (!isset($_SESSION['csrf_token']) || $submitted_token !== $_SESSION['csrf_token']) {
        // Token is invalid, handle the error (e.g., redirect or display an error message)
        die("CSRF token validation failed.");
    }
    $full_name = strip_tags($_POST['full_name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : false;
    $id = $_POST['id'];

    if ($email && strlen($full_name) >= 8) {
        // Prepare the query with placeholders
        $sql = "UPDATE admin SET full_name = ?, email = ? WHERE id = ?";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters to the placeholders
        mysqli_stmt_bind_param($stmt, "ssi", $full_name, $email, $id);

        // Execute the prepared statement
        $edit = mysqli_stmt_execute($stmt);

        if ($edit) {
            header("location: manage-admin.php");
            exit;
        } else {
            echo "Failed";
            header("location: manage-admin.php");
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('something went wrong');</script>";
    }
}
?>
