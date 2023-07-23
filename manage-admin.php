<?php
include "partials/header.php";
include "partials/menu.php";
?>
<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1 class="title">Manage Admin</h1>

        <br/>
        <?php
        if (isset($_SESSION['admin'])) {
            echo $_SESSION['admin'];
            unset($_SESSION['admin']);
        }
        ?>
        <br><br><br>
        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Addmin</a>

        <br/><br/><br/>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "select * from admin";
            $res = mysqli_query($conn, $sql);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $id = $row['id'];
                    $full_name = $row['full_name'];
                    $username = $row['email'];
                    $password = $row['password'];
                    ?>
                    <tr>
                        <td><?php echo $id?></td>
                        <td><?php echo $full_name?></td>
                        <td><?php echo $username?></td>
                        <td>
                            <a href="update-admin.php?id=<?php echo $id?>" class="btn-secondary"> update </a> &nbsp;
                            <a href="delete-admin.php?id=<?php echo $id?>" class="btn-danger"> delete </a>&nbsp;
                            <a href="update-password.php?id=<?php echo $id?>" class="btn-primary"> change password </a>&nbsp;
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>

                <tr>
                    <td>
                        <p> no admin yet ! </p>
                    </td>
                </tr>
                <?php
            }
            ?>


        </table>

    </div>
</div>
<!-- Main Content Setion Ends -->


<?php 
    include "./partials/footer.php"
?>