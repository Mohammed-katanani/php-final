<?php

include 'partials/header.php'; ?>
<div class="row">
    <?php include 'partials/menu.php'; ?>
    <div class="main-content manageProduct large-12 medium-12 small-12 columns light-grey-bg-pattern">
        <div class="row">
            <div class="large-12 columns">
                <div class="page-name">
                    <h3 class="left title">Welcome To Our Dashboard</h3>
                    <div class="clearfix"></div>
                    <div class="large-10 medium-12 small-12 columns light-grey-bg-pattern">
                        <div class="row">
                            <div class="large-10 columns">
                                <div class="page-name">
                                    <div class="clearfix"></div>
                                    <a class="button tiny radius success lable js-open-modal btn" href="add_products.php">Add products</a><br>
                                    <br>
                                    <?php
                                    if (isset($_SESSION['massege'])) {
                                        echo $_SESSION['massege'];
                                        unset($_SESSION['massege']);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="inbox">
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="custom-panel blue-bg">
                                        <div class="custom-panel-body">
                                            <table class="width-100 custom-table responsive js-dynamitable" id="resultTable">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>name</th>
                                                        <th>price</th>
                                                        <th>quantity</th>
                                                        <th>Image</th>
                                                        <th>-</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                $sql = "select * from products";
                                                $res = mysqli_query($conn, $sql);
                                                if ($res->num_rows > 0) {
                                                    while ($row = $res->fetch_assoc()) {
                                                        $id = $row['id'];
                                                        $name = $row['name'];
                                                        $price = $row['price'];
                                                        $quantity = $row['quantity'];
                                                        $image_name = $row['image_name'];
                                                ?>
                                                        <tr>
                                                            <td> <?php echo $id ?></td>
                                                            <td> <?php echo $name ?></td>
                                                            <td> <?php echo $price ?></td>
                                                            <td> <?php echo $quantity ?></td>
                                                            <td>
                                                                <img src="<?=$image_name?>" width="50px">
                                                            </td>

                                                            <td class="raghda">
                                                                <a class="alert label btn" style="background-color: #0a9d11" href="edit_product.php?id=<?php echo $id ?>">Update product</a>
                                                                <a class="alert label btn" href="delete-product.php?id=<?php echo $id ?>">Delete
                                                                    products</a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan="6">
                                                            <div class="error">No Products Added.</div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script src="js/vendor/jquery.js"></script>
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