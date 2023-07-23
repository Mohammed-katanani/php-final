<?php
include 'partials/constants.php';
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <link href="css/style.css" rel="stylesheet" />
    <style>
        html,
        body {
            height: 100%;
            background: #262c31;
        }

        .main {
            height: 100%;
            width: 100%;
            display: table;
        }

        .wrapper {
            display: table-cell;
            height: 100%;
            vertical-align: middle;
        }

        #login {
            width: 30%;
        }

        @media all and (max-width:800px) {
            #login {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="wrapper">
            <div id="login" class="row" style="margin: auto">
                <div class="large-12 columns text-center">

                    <form method="post" action="">
                        <input 
                            type="text"
                            placeholder="Email"
                            class="border-radius-top" 
                            name="email" 
                        />
                        <input 
                            type="password" 
                            placeholder="Password" 
                            class="no-radius" 
                            name="password" 
                        />
                        <input 
                            type="submit" 
                            name="Login" 
                            value="Login"
                            class="button small border-radius-bottom coral-bg" 
                            style="width: 100%">
                            
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

<?php
if (isset($_POST['Login'])) {
    $submitted_token = $_POST['csrf_token'];

    // Validate the token
    if (!isset($_SESSION['csrf_token']) || $submitted_token !== $_SESSION['csrf_token']) {
        // Token is invalid, handle the error (e.g., redirect or display an error message)
        die("CSRF token validation failed.");
    }
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    // $password = $_POST['password'];

    // Prepare the query with placeholders
    $query = "SELECT * FROM admin WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters to the placeholders
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $row['id'];
        header("location: index.php");
        echo '<script>alert("Valid User ID/Password");</script>';
        exit();
    } else {
        echo '<script>alert("Invalid User ID/Password");</script>';

    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}
?>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>

</html>