<?php
include('connection.php');
session_start();
if(!isset($_SESSION["EmployeeID"])) {
  header('Location: employeelogin.php');
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <title></title>
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
        <li><a class="menu-link" href="employeeportal.php">Product list</a></li>
        <li><a class="menu-link" href="employeeportal_addproduct.php">Add a new product</a></li>
        <li class="username"><?=$_SESSION["EmployeeName"]?></li>
        </ul>
        </div>
        <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="logout"></a>
      </nav>
    </section>
      <section class="portal-main">
        <div class="options-menu">
          <h2>List of Products</h2>
          <?php
          /*displaying information about changes in the product database*/
              if(isset($_GET['message']))
              {
                $message = $_GET['message'];
                if($message == 'editsuccess')
                {
                  echo '<h3>Product information has been successfully changed!</h3>';
                }
                else if($message == 'addsuccess')
                {
                  echo '<h3>New product successfully added!</h3>';
                }
                else if($message == 'deletesuccess')
                {
                  echo '<h3>The product has been removed!</h3>';
                }
                else{}
            }
          ?>
          <ul>
            <li>
              <div class="column">
                <p>Photo</p>
              </div>
              <div class="column">
                <p>Name</p>
              </div>
              <div class="column">
                <p>price</p>
              </div>
              <div class="column">
                <p>Quantity in stock</p>
              </div>
              <div class="column">
                <p>Icing</p>
              </div>
              <div class="column">
                <p>Sprinkles</p>
              </div>
              <div class="column">
                <p>Filling</p>
              </div>
              <div class="column">
                  <a href="employeeportal_addproduct.php"><button class="add-list-button" type="button" name="button">Add a new product</button></a>
              </div>
            </li>

              <?php
              /*displaying all products from the database and connecting buttons to refer to appropriate processes*/
                            
              openConnection();
              global $serwer;
              
              $zapytanie = "select product.ImageID, product.Name, product.Price, product.AmountOnStock, glaze.Name, sprinkle.Name, filling.Name, product.Hashtag, product.ProductID from product,sprinkle,filling,glaze where sprinkle.SprinkleID=Sprinkle && filling.FillingID=Filling && glaze.GlazeID=Glaze group by ProductID";
              	$wynik = mysqli_query($serwer, $zapytanie);
              	if(!$wynik) return;

              	while($wiersz = mysqli_fetch_row($wynik))
                {
                  echo'
                  <li>
                 <div class="column">
                   <img src="icons/'.$wiersz[0].'" alt="'.$wiersz[7].'">
                 </div>
                 <div class="column">
                   <p><b>'.$wiersz[1].'</b></p>
                 </div>
                 <div class="column">
                 <p>'.$wiersz[2].' zł</p>
                 </div>
                 <div class="column">
                 <p>'.$wiersz[3].'</p>
                 </div>
                 <div class="column">
                 <p>'.$wiersz[4].'</p>
                 </div>
                 <div class="column">
                 <p>'.$wiersz[5].'</p>
                 </div>
                 <div class="column">
                 <p>'.$wiersz[6].'</p>
                 </div>
                 <div class="column">
                   <div class="buttons-list">
                   <a class="links-ids" href="employeeportal_editproduct.php?id='.$wiersz[8].'">Edit</a>
                   <a class="links-ids" href="deleteprocess.php?id='.$wiersz[8].'">Delete</a>
                   </div>
                 </div>
               </li>
                  ';
              	}
              	mysqli_free_result($wynik);
                closeConnection();
               ?>
          </ul>
        </div>
    </section>
  </body>
</html>
