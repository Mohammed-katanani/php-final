<!DOCTYPE html>
<html>

<head>
  <title>Available Products</title>
  <link rel="stylesheet" type="text/css" href="css/newStyle.css">
</head>

<body>
  <?php
   include "./partials/header.php"
   ?>
  <div class="container">

    <h1 class="title">Available Products</h1>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>image</th>
      </tr>
      <?php
      $q = "SELECT * FROM products";
      $result = mysqli_query($conn, $q);

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td> <img src='" . $row['image_name'] . "' alt='img' width='120px'></td>";
        echo "</tr>";
      }
      ?>

    </table>
  </div>
  <?php
   include "./partials/footer.php"
   ?>
</body>

</html>