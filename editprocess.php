<?php
include('connection.php');
//the party responsible for editing the product
$id = $_GET['id'];

openConnection();
global $serwer;

if(isset($_POST['update']))
{
  //getting the given values
  $name = $_POST['name'];
  $price = $_POST['price'];
  $amount = $_POST['amount'];
  $glaze = $_POST['glaze-list'];
  $sprinkle = $_POST['sprinkle-list'];
  $filling = $_POST['filling-list'];

  //changing the values ​​from the 'product' table columns to new ones
  $query = "update product set Name='$name', Price='$price', AmountOnStock='$amount', Glaze='$glaze', Sprinkle='$sprinkle', Filling='$filling' where ProductID=$id;";
  mysqli_query($serwer, $query);
  closeConnection();
  header('Location: employeeportal.php?message=editsuccess');
}
?>
