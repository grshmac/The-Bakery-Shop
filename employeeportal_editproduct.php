<?php

include("functions.php");
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
  <?php
    $id = $_GET['id'];
  ?>
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

      <section class="main-edit">
        <div class="options-edit">
          <h2>Edit Product</h2>
          <ul>
            <?php
            /*displaying information about the selected product from the database according to its ID and updating information about the product in the database*/
              $id = $_GET['id'];

              openConnection();
              global $serwer;
              //downloading product data from the database
              $zapytanie = "select product.ImageID, product.Name, product.Price, product.AmountOnStock, glaze.Name, sprinkle.Name, filling.Name, product.Hashtag, product.ProductID from product,sprinkle,filling,glaze where ProductID=$id && sprinkle.SprinkleID=Sprinkle && filling.FillingID=Filling && glaze.GlazeID=Glaze";
              $getGlaze = mysqli_query($serwer, "SELECT * FROM glaze");
              $getSprinkle = mysqli_query($serwer, "SELECT * FROM sprinkle");
              $getFilling = mysqli_query($serwer, "SELECT * FROM filling");
              $wynik = mysqli_query($serwer, $zapytanie);
              if(!$wynik) return;

              $wiersz = mysqli_fetch_row($wynik);
              ?>
                <li>
                <form class="form-edit" action="editprocess.php?id=<?=$wiersz[8]?>" method="post">
               <div class="column-edit">
                 <img src="icons/<?=$wiersz[0]?>" alt="<?=$wiersz[7]?>">
               </div>
               <div class="column-edit">
               <p class="column-p">Name:</p>
               <input type="text" name="name" value="<?=$wiersz[1]?>">
               </div>
               <div class="column-edit">
               <p class="column-p">Price:</p>
               <input type="text" name="price" value="<?=$wiersz[2]?>">
               </div>
               <div class="column-edit">
               <p class="column-p">Quantity in stock:</p>
               <input type="text" name="amount" value="<?=$wiersz[3]?>">
               </div>
               <div class="column-edit">
               <p class="column-p">Icing:</p>
               <!--tworzenie listy wyboru za pomoca funkcji 'selectedList'-->
                <?=selectedList($getGlaze,'glaze-list','GlazeID',$wiersz[4])?>
               </div>
               <div class="column-edit">
               <p class="column-p">Sprinkles:</p>
               <!--tworzenie listy wyboru za pomoca funkcji 'selectedList'-->
                <?=selectedList($getSprinkle,'sprinkle-list','SprinkleID',$wiersz[5])?>
               </div>
               <div class="column-edit">
               <p class="column-p">Filling:</p>
               <!--tworzenie listy wyboru za pomoca funkcji 'selectedList'-->
                <?=selectedList($getFilling,'filling-list','FillingID',$wiersz[6])?>
               </div>
               <div class="save-column">
                   <input type="submit" name="update" value="Zapisz">
               </div>
               </form>
             </li>
             <?php
             mysqli_free_result($wynik);
             closeConnection();
              ?>
          </ul>
        </div>
    </section>
  </body>
</html>
