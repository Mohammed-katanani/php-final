<?php
include "partials/header.php";
include "partials/menu.php";

// Generate and store the CSRF token if it doesn't exist
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <form action="" method="POST">

            <table class="">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" minlength="8" required>
                    </td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email" placeholder="Your email" required>
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" minlength="6" required placeholder="Your Password">
                    </td>
                    <td>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // Retrieve the submitted CSRF token
    $submitted_token = $_POST['csrf_token'];

    // Validate the token
    if (!isset($_SESSION['csrf_token']) || $submitted_token !== $_SESSION['csrf_token']) {
        // Token is invalid, handle the error (e.g., redirect or display an error message)
        die("CSRF token validation failed.");
    }
    $full_name = strip_tags($_POST['full_name']);// <h1>test</h1> xss 
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : false;
    $password = md5($_POST['password']);
    // check if valid email and name after the validation
    if ($email && strlen($full_name) >= 8) {
        // Prepare the query with placeholders
        $sql = "INSERT INTO admin (full_name, email, password) VALUES (?, ?, ?)"; //sql
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameters to the placeholders
        mysqli_stmt_bind_param($stmt, "sss", $full_name, $email, $password);

        // Execute the prepared statement
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            $_SESSION['massege'] = "<span style='color: #2ed573'>admin is added</span>";
            header("location: manage-admin.php");
        } else {
            $_SESSION['massege'] = "<span style='color: red'>admin is not added</span>";
            header("location: manage-admin.php");
        }
        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else
        echo "<script>alert('something went wrong');</script>";
}

include "./partials/footer.php";
