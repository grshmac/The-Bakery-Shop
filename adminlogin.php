<!-- Admin login -->
<?php
/**
* displaying information if login failed or if the admin was successfully registered
*/
include('head2.php');
include('connection.php');
session_start();

if(isset($_SESSION["UserID"]) || isset($_SESSION["EmployeeID"])){
  echo '<script>window.location="index.php"</script>';
}
if(isset($_GET['msg']))
{
  $messageID = $_GET['msg'];
}else{
  $messageID = 0;
}

if($messageID == 1)
{
  $msg = "Invalid login details!";
}
else{
  $msg = "";
}
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- <link rel="stylesheet" href="style.css"> -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
  .main{
  font-family: 'Poppins', sans-serif;
  height: 100%;
  width: 100%;
  background-image: linear-gradient(rgba(4,9,30,0.7),rgba(4,9,39,0.7)),url(imagesbake/banner6.jpg);
  background-position: center;
  background-size: cover;
  position: fixed;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
}
.login-section{
  border-radius: 5px;
  height: 55%;
  width: 40%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.login-section h2{
  margin-bottom: 30px;
}
.login-form{
  width: 80%;
}
.login-input{
  border: none;
  width: 70%;
  margin: 7px;
  background: gainsboro;
  padding: 10px 10px;
  border-radius: 2px;
}
.login-submit{
  border:none;
  border-radius: 2px;
  background: wheat;
  margin: 10px;
  width: 70%;
  padding: 12px 0px;
  color: black;
  transition: all 0.1s ease-out;
}
.login-submit:hover{
  background: gray;
  cursor: pointer;
}
.login-form form{
  display: flex;
  flex-direction: column;
  width: 100%;
  align-items: center;
}
</style>
</head>

  <body>
      <section class="main">
      <div class="login-section">
        <h2 style="color: wheat; background-color:olive;">Login to admin portal</h2>

        <div class="login-form">
          <form action="" method="post">
          <input class="login-input" type="text" name="employeeID" placeholder="Admin ID">
          <input class="login-input" type="password" name="password" placeholder="Password">
          <input class="login-submit" type="submit" name="login-submit" value="Submit">
        </form>
        </div>

        <p class="password-change-info"><?php echo $msg; ?></p>
      </div>
    </section>
  </body>
</html>

<?php
/**
* admin login process, if login is successful, redirection to the product service page
*/
if(!empty($_POST['employeeID']) and !empty($_POST['password']))
{
  $employeeID = $_POST['employeeID'];
  $password = $_POST['password'];

  openConnection();
  global $serwer;
  //retrieving an employee's password from the database
  $getPassword = mysqli_fetch_array(mysqli_query($serwer, "SELECT Password FROM employee WHERE EmployeeID = '$employeeID'"));
  $userPassword = $getPassword[0];

  //comparing the given password with the password from the database
  if($password == $userPassword)
  {
    //downloading employee data from the database
    $getInfo = mysqli_fetch_array(mysqli_query($serwer, "SELECT * FROM employee WHERE EmployeeID = '$employeeID'"));

    $_SESSION["EmployeeID"] = $getInfo[2];
    $_SESSION["EmployeeName"] = $getInfo[0]." ".$getInfo[1];
    header('Location:employeeportal.php');
  }
  else
  {
    header('Location:adminlogin.php?msg=1');
  }
  closeConnection();
}
else
{
}
 ?>
