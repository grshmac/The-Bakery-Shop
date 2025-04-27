<?php

include('cart_addfunc.php');
include('connection.php');

session_start();
if(isset($_SESSION["EmployeeID"])){
   echo '<script>window.location="index.php"</script>';
}

if(isset($_GET['msg']))
{
  $messageID = $_GET['msg'];
}else{
  $messageID = 0;
}
switch ($messageID) {
  case 0:
    $msg = "";
    break;
    case 1:
      $msg = "The product has been added to the cart!";
      break;
      case 2:
        $msg = "Unable to add product!";
        break;
  default:
    $msg = "";
    break;
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
        <li><a class="menu-link" href="menu.php">Menu</a></li>
        <?php
        /*changing navigation depending on whether the user is logged in or not*/
        if(isset($_SESSION["UserID"])){
          echo '<li><a class="menu-link" href="userpanel.php">AccInfo</a></li>
          <li><a class="menu-link" href="orderhistory.php">Wishlist</a></li>
          <li><a class="menu-link" href="cart.php">Basket<span class="material-symbols-outlined">shopping_basket</span></a></li>
          </ul>
          </div>
          <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="log out"></a>';
        }
        else{
          echo '<li><a class="menu-link" href="adminlogin.php">Admin</a></li>
          <li><a class="menu-link" href="login.php">Basket<span class="material-symbols-outlined">shopping_basket</span></a></li>
          <li><a class="link-button" href="login.php">Login</a></li>
          </ul>
          </div>';
        }
        ?>
      </nav>
    </section>

    <section class="banner">
      <h1>Menu</h1>
    </section>

    <section class="menu">
      <p class="info-menu"><?php echo $msg; ?></p>
      <div class="menu-list">

      <?php
        /**displaying all products in the restaurant's stock from the database*/
      openConnection();
      global $serwer;
        	$zapytanie = "select ImageID, Name, Price, Hashtag, ProductID, AmountOnStock from product";
        	$wynik = mysqli_query($serwer, $zapytanie);
        	if(!$wynik) return;
          echo '<form class="menu-list-form" method=POST action=>';
          //a loop displaying all products from the database
        	while($wiersz = mysqli_fetch_row($wynik))
          {
            if($wiersz[5] > 0){
              echo '
              <div class="product">
              <a href="product_description.php?id='.$wiersz[4].'">
                <img src="icons/'.$wiersz[0].'" alt="'.$wiersz[3].'">
                <p class="title-product">'. $wiersz[1] .'</p>
                <p class="price-product">'.$wiersz[2].' NPR</p>
                </a>
                <button class="add-button" type="submit" name="button['.$wiersz[4].']" value="Add">add to cart</button>
              </div>
              ';
            }
        	}
          echo '</form>';
        	mysqli_free_result($wynik);
         ?>
      </div>
    </section>

    <?php
    /*adding a product to the cart*/
    $request='';
    if(isset($_POST["button"])) {
      session_start();
      if(isset($_SESSION["UserID"])) {
      $nr = key($_POST["button"]);
      $request = $_POST["button"][$nr];
      }
      else{
        echo '<script>window.location="login.php"</script>';
      }
    }
    switch($request) {
      case "Add": addToCart($nr,1); break;
    }
    closeConnection();
    ?>
    
  <section class="footer">
    <div class="column-footer">
      <a href="index.php"><img class="logo" src="imagesbake/logo3.avif" alt="Bake Logo"></a>
    </div>
    <div class="column-footer">
      <p>Location:<br><i>DurbarMarg<br>03-330 TreeHouse</i></p>
    </div>
    <div class="column-footer">
      <p>Contact:<br><i>01462718<br>thebakeryhouse@gmail.com</i></p>
    </div>
    <div class="column-footer">
    </div>
  </section>

  </body>
</html>
