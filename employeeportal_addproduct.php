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
    
    <section class="portal-add">
      <div class="add-container">
        <h2>Add New Product</h2>
        <?php
        /*displaying the product options available from the database, such as topping, topping and filling*/
        $message = "";

        openConnection();
        global $serwer;
        
        $getGlaze = mysqli_query($serwer, "SELECT * FROM glaze");
        $getSprinkle = mysqli_query($serwer, "SELECT * FROM sprinkle");
        $getFilling = mysqli_query($serwer, "SELECT * FROM filling");
         ?>
        <form class="add-new-form" action="" enctype="multipart/form-data" method="post">
          <div class="text-inputs">
          <div class="column-form">
            <label for="name">Product name</label>
            <input type="text" name="name" value="">

            <label for="price">Price</label>
            <input type="text" name="price" value="">

            <label for="amount">Quantity in stock</label>
            <input type="text" name="amount" value="">
          </div>
          <div class="column-form">
            
          <label for="glaze">Icing</label>
          <!--creating a selection list using functions 'newList'-->
            <?=newList($getGlaze,'glaze-list','GlazeID');?>

          <label for="sprinkle">Sprinkles</label>
          <!--creating a selection list using functions 'newList'-->
            <?=newList($getSprinkle,'sprinkle-list','SprinkleID');?>

          <label for="filling">Filling</label>
          <!--creating a selection list using functions'newList'-->
          <?=newList($getFilling,'filling-list','FillingID');?>

        </div>
      </div>
        <div class="row-form">
          <div class="file-row">
            <label for="new-file">Add a product photo</label>
            <input type="file" name="new-file" />
          </div>
          <input type="submit" name="submit" value="Add">
        </div>
        </form>
       </div>
       <?php
       /*adding a new product to the database according to the data provided by the employee*/
       if(!empty($_POST['name']) and !empty($_POST['price']) and !empty($_POST['amount']) and !empty($_POST['glaze-list']) and !empty($_POST['sprinkle-list']) and !empty($_POST['filling-list']))
       {
           $name = $_POST['name'];
           $price = $_POST['price'];
           $amount = $_POST['amount'];
           $glaze = $_POST['glaze-list'];
           $sprinkle = $_POST['sprinkle-list'];
           $filling = $_POST['filling-list'];
           /*adding a product photo to the folder with icons and its address to the database*/
           if (($_FILES['new-file']['name']!=""))
           {
              $target_dir = "icons/";
              $file = $_FILES['new-file']['name'];
              $path = pathinfo($file);
              $filename = $path['filename'];
              $ext = $path['extension'];
              $temp_name = $_FILES['new-file']['tmp_name'];
              $path_filename_ext = $target_dir.$filename.".".$ext;

               if (file_exists($path_filename_ext))
               {
                 echo "<p>A file with the same name already exists!</p>";
               }
               else
               {
                  move_uploaded_file($temp_name,$path_filename_ext);
               }
             }
           $newname = $_FILES['new-file']['name'];

           $query = "INSERT INTO `product` (`Name`, `Price`, `AmountOnStock`, `Glaze`,`Sprinkle`, `Filling`, `ImageID`, `Hashtag`) VALUES ('$name', '$price', '$amount', '$glaze','$sprinkle', '$filling', '$newname', '$filename');";
           mysqli_query($serwer, $query);
           closeConnection();
           header('Location: employeeportal.php?message=addsuccess');
       }
       else{}
        ?>
  </section>
  </body>
</html>
