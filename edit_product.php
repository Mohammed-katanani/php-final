<?php include 'partials/header.php';
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $id = $row['id'];
    $name = $row['name'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $image_name = $row['image_name'];
} else {
    $_SESSION['massege'] = "product is not updated";
    header("location:manage-products.php");
}

if (isset($_POST['submit'])) {
    $submitted_token = $_POST['csrf_token'];
    if (!isset($_SESSION['csrf_token']) || $submitted_token !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }
    $name = strip_tags($_POST['name']);
    $price = strip_tags($_POST['price']);
    $quantity = strip_tags($_POST['quantity']);

    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $tmpname = $_FILES['image']['tmp_name'];
        $image_name = "./images/$name.$ext";
        move_uploaded_file($tmpname, $image_name);
    }
    $sql = "UPDATE products SET name = ?, price = ?, quantity = ?, image_name = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssdsi", $name, $price, $quantity, $image_name, $id);
    $edit = mysqli_stmt_execute($stmt);

    if ($edit) {
        $_SESSION['massege'] = "product is edited";
        header("location:manage-products.php");
    } else {
        $_SESSION['massege'] = "product is not edited";
        header("location:manage-products.php");
    }
}

?>
<div class="row edit_product">
    <?php include 'partials/menu.php'; ?>
    <div class="large-10 medium-12 small-12 columns light-grey-bg-pattern">
        <div id="dashboard">
            <div class="row">
                <div class="large-12 columns">
                    <div class="custom-panel">
                        <div class="custom-panel-heading">
                            <h4>Edit products</h4>
                        </div>

                        <div class="custom-panel-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <label> 
                                    <span>name :</span>
                                    <input type="text" name="name" value="<?php echo $name; ?>" required="required">
                                </label>
                                <label> 
                                    <span>price :</span>
                                    <input type="text" id="price" name="price" pattern="\d+(\.\d{2})?" value="<?php echo $price; ?>" required>
                                </label>
                                <label> 
                                    <span>quantity :</span>
                                    <input type="number" style="max-width: 500px;" id="quantity" name="quantity" min="1" value="<?php echo $quantity; ?>" required>
                                </label>
                                <label> 
                                    <span>Image</span>
                                    <input type="file" name="image" accept=".jpg, .jpeg,.png" />
                                </label> 
                                <label style="margin: -15px 0; padding: 0;">
                                    <span>&nbsp;</span>
                                    <div class="message msgpic1"></div>
                                </label>
                                <div class="clearfix"></div>
                                <label> 
                                    <span>Image1</span> 
                                    <img src="<?=$image_name?>" width="100px" height="90px" /> 
                                </label>
                                <br>
                                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                <input type="submit" class="button tiny radius coral-bg right" name="submit" value="Update Category">
                                <div class="clearfix"></div>
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
<script src="js/foundation.min.js"></script>
<script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="js/plugins/morris/morris.js"></script>
<script src="js/menu.js"></script>
<script>
    $(document).foundation();
</script>
<script src="js/morris-demo.js"></script>
<script>
    $(function() {
        $(".datepicker").datepicker();
    });
</script>
</body>

</html>