<?php
//the is responsible for removing the product from the database
$id = $_GET['id'];

include('connection.php');
openConnection();
global $serwer;

$query = "delete from product where ProductID=$id;";
mysqli_query($serwer, $query);
closeConnection();
header('Location: employeeportal.php?message=deletesuccess');

?>
