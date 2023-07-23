<?php
include "partials/header.php";
include "partials/menu.php";

$sql_admin = "select * from admin";
$res_admin = mysqli_query($conn, $sql_admin);
$sql_products = "select * from products";
$res_products = mysqli_query($conn, $sql_products);

?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper text-center">
        <h1 class="title">Dashboard</h1>
        <br><br>
        <br><br>
        <div class="content">
            <div class=" text-center">
                <h1>
                    <?php echo $res_admin->num_rows ?>
                </h1>
                <br />
                Admins
            </div>
            <div class="text-center">
                <h1>
                    <?php echo $res_products->num_rows ?>
                </h1>
                <br />
                products
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php 
    include "./partials/footer.php"
?>