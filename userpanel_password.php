<?php
session_start();
if(!isset($_SESSION["UserID"])){
  echo '<script>window.location="index.php"</script>';
}
if (isset($_GET['message'])) {
  $messageID = $_GET['message'];
}
else {
  $messageID = 1;
}
switch ($messageID) {
  case 1:
    $message = "";
    break;
      case 2:
        $message = "The passwords provided are different!";
        break;
        case 3:
          $message = "The password entered is incorrect!";
          break;
          case 4:
            $message = "Not all required fields have been completed!";
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
      <li><a class="menu-link" href="orderhistory.php">Purchase history</a></li>
      <li><a class="menu-link" href="cart.php">Basket<span class="material-symbols-outlined">shopping_basket</span></a></li>
      </ul>
      </div>
      <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="log out"></a>
    </nav>
  </section>
    <section class="main">
    <div class="userpanel-section">
      <h2>Edit password</h2>
      <form class="userpanel-form" action="editpasswordprocess.php" method="post">
      <h4>Old Password</h4>
      <input type="password" name="oldpassword">
      <h4>A new password</h4>
      <input type="password" name="newpassword">
      <h4>Repeat password</h4>
      <input type="password" name="repeatpassword"><br>
      <p class="password-change-info"><?php echo $message; ?></p>
      <input type="submit" name="changepassword" value="Save">
      </form>
      <a class="cancel-button" href="userpanel.php">Cancel</a>
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
