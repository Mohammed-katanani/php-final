<?php
include 'partials/header.php';

// Generate and store the CSRF token if it doesn't exist
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

if (isset($_POST['submit'])) {
    // Retrieve the submitted CSRF token
    $submitted_token = $_POST['csrf_token'];

    // Validate the token
    if (!isset($_SESSION['csrf_token']) || $submitted_token !== $_SESSION['csrf_token']) {
        // Token is invalid, handle the error (e.g., redirect or display an error message)
        die("CSRF token validation failed.");
    }
    
    $name = strip_tags($_POST['name']);
    $price = strip_tags($_POST['price']);
    $quantity = strip_tags($_POST['quantity']);
    $image_name = "";
    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $tmpname = $_FILES['image']['tmp_name'];
        $image_name = "./images/$name.$ext";
        move_uploaded_file($tmpname, $image_name);
    }
    // Prepare the query with placeholders
    $sql = "INSERT INTO products (name, price,quantity, image_name) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters to the placeholders
    mysqli_stmt_bind_param($stmt, "sdds", $name, $price, $quantity ,$image_name);

    // Execute the prepared statement
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        $_SESSION['admin'] = "products is added";
        header("location: manage-products.php");
    } else {
        $_SESSION['admin'] = "products is not added";
        header("location: manage-products.php");
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

?>
<div class="row">
    <?php include 'partials/menu.php'; ?>
    <div class="large-12 medium-12 small-12 columns light-grey-bg-pattern ">
        <div id="dashboard">
            <div class="row">
                <div class="large-12 columns">
                    <div class="custom-panel">
                        <div class="custom-panel-heading">
                            <h4 style="color:red">Add products</h4>
                        </div>
                        <div class="custom-panel-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <label>
                                    <span>name :</span> <input type="text" name="name" placeholder="product name" required />
                                </label>
                                <label>
                                    <span>price 0.00:</span> <input type="text" id="price" name="price" pattern="\d+(\.\d{2})?" required>
                                </label>
                                <label>
                                    <span>quantity :</span> <input type="number" id="quantity" style="max-width: 500px;" name="quantity" min="1" required>
                                </label>
                                <label> <span>upload Image :</span>
                                    <input type="file" name="image" placeholder="Category" required />
                                    <label><span>&nbsp;</span>
                                        <input type="submit" name="submit" class="button tiny radius coral-bg right" value="Add">
                                    </label>
                                    <div class="clearfix"></div>
                                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    include "./partials/footer.php"
?>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script>
    $(function() {
        $("#datepicker").datepicker();
    });
</script>
<script src="js/foundation.min.js"></script>
<script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="js/plugins/morris/morris.js"></script>
<script src="js/menu.js"></script>
<script>
    $(document).foundation();
</script>
<script src="js/morris-demo.js"></script>
</body>

</html>