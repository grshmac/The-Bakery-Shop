<?php
include('connection.php');
session_start();
if (!isset($_SESSION["EmployeeID"])) {
  header('Location: employeelogin.php');
  exit();
}
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Product Management</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
  <section class="header">
    <nav>
      <a href="index.php"><img src="imagesbake/logo3.avif" alt="Bake" width="40rem"></a>
      <div class="nav-links" id="navLinks">
        <ul>
          <li><a class="menu-link" href="index.php">Home</a></li>
          <li><a class="menu-link" href="employeeportal.php">Product List</a></li>
          <li><a class="menu-link" href="employeeportal_addproduct.php">Add Product</a></li>
          <li class="username"><?=$_SESSION["EmployeeName"]?></li>
        </ul>
      </div>
      <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="logout"></a>
    </nav>
  </section>

  <section class="portal-main">
    <div class="options-menu">
      <h2>Product Inventory</h2>
      <?php
        if (isset($_GET['message'])) {
          $messages = [
            'editsuccess' => 'Product information updated successfully!',
            'addsuccess' => 'Product added successfully!',
            'deletesuccess' => 'Product deleted successfully!'
          ];
          if (array_key_exists($_GET['message'], $messages)) {
            echo '<h3>' . $messages[$_GET['message']] . '</h3>';
          }
        }
      ?>
      <ul>
        <li>
          <div class="column"><p>Photo</p></div>
          <div class="column"><p>Name</p></div>
          <div class="column"><p>Price</p></div>
          <div class="column"><p>Stock</p></div>
          <div class="column"><p>Glaze</p></div>
          <div class="column"><p>Sprinkles</p></div>
          <div class="column"><p>Filling</p></div>
          <div class="column">
            <a href="employeeportal_addproduct.php">
              <button class="add-list-button" type="button">Add Product</button>
            </a>
          </div>
        </li>

        <?php
        openConnection();
        global $conn;

        $query = "
          SELECT p.ImageID, p.Name, p.Price, p.AmountOnStock,
                 g.Name AS GlazeName, s.Name AS SprinkleName, f.Name AS FillingName,
                 p.Hashtag, p.ProductID
          FROM product p
          JOIN sprinkle s ON p.Sprinkle = s.SprinkleID
          JOIN filling f ON p.Filling = f.FillingID
          JOIN glaze g ON p.Glaze = g.GlazeID
        ";

        $result = mysqli_query($conn, $query);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>
              <div class="column"><img src="icons/' . $row['ImageID'] . '" alt="' . $row['Hashtag'] . '"></div>
              <div class="column"><p><b>' . $row['Name'] . '</b></p></div>
              <div class="column"><p>' . $row['Price'] . ' NPR</p></div>
              <div class="column"><p>' . $row['AmountOnStock'] . '</p></div>
              <div class="column"><p>' . $row['GlazeName'] . '</p></div>
              <div class="column"><p>' . $row['SprinkleName'] . '</p></div>
              <div class="column"><p>' . $row['FillingName'] . '</p></div>
              <div class="column">
                <div class="buttons-list">
                  <a class="links-ids" href="employeeportal_editproduct.php?id=' . $row['ProductID'] . '">Edit</a>
                  <a class="links-ids" href="deleteprocess.php?id=' . $row['ProductID'] . '">Delete</a>
                </div>
              </div>
            </li>';
          }
          mysqli_free_result($result);
        }
        closeConnection();
        ?>
      </ul>
    </div>
  </section>
</body>
</html>
