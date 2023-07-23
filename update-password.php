<?php
include "partials/header.php";
include "partials/menu.php";
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    // $sql = "select * from admin where id = '$id'";
    // $res = mysqli_query($conn, $sql);
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $old_password = $row['password'];
    }
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <?php
        if (isset($_SESSION['admin'])) {
            echo $_SESSION['admin'];
            unset($_SESSION['admin']);
        }
        ?>
        <br>
        <form action="" method="POST">
            <table class="tbl-60">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" required>
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" minlength="6" placeholder="New Password" required>
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $submitted_token = $_POST['csrf_token'];

    // Validate the token
    if (!isset($_SESSION['csrf_token']) || $submitted_token !== $_SESSION['csrf_token']) {
        // Token is invalid, handle the error (e.g., redirect or display an error message)
        die("CSRF token validation failed.");
    }
    $current_password = md5($_POST['current_password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($old_password == $current_password) {
        if ($new_password == $confirm_password) {
            $new_password_enc = md5($new_password);
            // $sql = "update admin set password = '$new_password_enc' where id = '$id'";
            // $res = mysqli_query($conn, $sql);
            $sql = "UPDATE admin SET password = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $new_password_enc, $id);
            $res = mysqli_stmt_execute($stmt);
            if ($res) {
                $_SESSION['admin'] = "<span style='color: #2ed573'>Password changed</span>";
                header("location:manage-admin.php?id=$id");
            } else {
                $_SESSION['admin'] = "<span style='color: red'>Password not changed</span>";
                header("location:update-password.php?id=$id");
            }
        } else {
            $_SESSION['admin'] = "<span style='color: red'>Password not matched</span>";
            header("location:update-password.php?id=$id");
        }
    } else {
        $_SESSION['admin'] = "<span style='color:red'>Password not correct</span>";
        header("location:update-password.php?id=$id");
    }
}