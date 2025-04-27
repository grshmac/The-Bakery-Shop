<!-- page with logged in user data -->
<?php
/**
*displaying information if the data or password change was successful
*/
include('connection.php');
session_start();
if(!isset($_SESSION["UserID"])){
  echo '<script>window.location="index.php"</script>';
}
if (isset($_GET['message'])) {
  $messageID = $_GET['message'];
}
else {
  $messageID = 0;
}
switch ($messageID) {
  case 0:
    $message = "";
    break;
  case 1:
    $message = "Password has been changed!";
    break;
      case 2:
        $message = "User details have been changed!";
        break;
  default:
    $message = "";
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
      <li><a class="menu-link" href="userpanel.php">AccInfo</a></li>
      <li><a class="menu-link" href="orderhistory.php">Wishlist</a></li>
      <li><a class="menu-link" href="cart.php">Basket<span class="material-symbols-outlined">shopping_basket</span></a></li>
      </ul>
      </div>
      <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="log out"></a>
    </nav>
    <?php
    /**
    *displaying user data from the database
    */
        openConnection();
        global $serwer;
            try{
        	  $zapytanie = "select Name, Surname, email from user where UserID=$_SESSION[UserID]";
        	  $wynik = mysqli_fetch_array(mysqli_query($serwer, $zapytanie));
        	  if(!$wynik) return;
              $_SESSION["name"] = $wynik[0]." ".$wynik[1];
              $_SESSION["email"] = $wynik[2];
              closeConnection();
            }
            catch(Exception){
                session_destroy();
                closeConnection();
                header('Location: login.php');
                exit();
            }
         ?>
  </section>
    <section class="main">
    <div class="userpanel-section">
      <h2>Account information</h2>
      <h3>First name and last name</h3>
      <p><?=$_SESSION["name"]?></p>
      <h3>E-mail adress</h3>
      <p><?=$_SESSION["email"]?></p>
      <p class="p-info"><?php echo $message; ?></p>
      <div class="userpanel-buttons">
      <a href="userpanel_edit.php">Edit data</a>
      <a href="userpanel_password.php">Edit Password</a>
    </div>
    </div>
  </section>
  <section class="footer">
    <div class="column-footer">
      <a href="index.php"><img class="logo" src="imagesbake/logo3.avif" alt="Donut House Logo"></a>
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
