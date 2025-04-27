<?php
/*isplaying product information according to the given product id during redirection*/
session_start();
$id = $_GET['id'];
include('connection.php');

if(isset($_SESSION["EmployeeID"])){
   echo '<script>window.location="index.php"</script>';
}

/*file with the function that adds a product to the cart in the current session*/
include('cart_addfunc.php');
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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

    <section class="product-ui">
      <div class="window-product">
          <a href="menu.php">Back to menu</a>
          <div class="product-row">
            <?php
            /*downloading product information by ID from the database and displaying it*/
            $id = $_GET['id'];
            openConnection();

            global $serwer;
              $zapytanie = "select product.ImageID, product.Name, product.Price, product.AmountOnStock, product.Hashtag, product.ProductID from product where ProductID=$id";
              $wynik = mysqli_query($serwer, $zapytanie);
              if(!$wynik) return;
              $wiersz = mysqli_fetch_row($wynik);
                echo'
                <img src="icons/'.$wiersz[0].'" alt="'.$wiersz[7].'">
                <div class="info-panel">
                  <h3>'.$wiersz[1].'</h3>
                  <p>'.$wiersz[2].' NPR</p>
                  <h4>Accessories:</h4>
                  <p>Icing: '.$wiersz[4].'</p>
                  <p>Sprinkles: '.$wiersz[5].'</p>
                  <p>Filling: '.$wiersz[6].'</p>
                  <form class="add-form-order" action="" method="post">
                    <input type="number" name="amount" min="1" max='.$wiersz[3].'>
                    <input type="submit" name="submit" value="Wishlist">
                  </form>
                </div>';
             ?>
        </div>
      </div>
    </section>

    <?php
    /*adding a given product and its quantity to the cart - addToCart function*/
    $request='';
    if(isset($_POST["submit"])) {
      if(isset($_SESSION["UserID"])) {
        $nr = $wiersz[8];
        $amount = $_POST["amount"];
        $request = "Add";
      }
      else{
        header('Location: login.php');
      }
    }

    switch($request) {
      case "Dodaj": addToCart($nr,$amount); break;
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
