<!-- User registration page -->
<?php
/**
* display information if registration failed
*/
include 'head2.php';
include('connection.php');
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
  $msg = "Registration failed! Please enter correct details!";
}
else{
  $msg = "";
}
?>


<html>
   <head>
     <meta charset="utf-8">
     <title>Register</title>
     <!-- <link rel="stylesheet" href="style.css"> -->
 <!-- <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  -->
<style>
  /* register */
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
.login-input{
  border: none;
  width: 70%;
  margin: 7px;
  background: gainsboro;
  padding: 10px 10px;
  border-radius: 2px;
}
.register-section{
  border-radius: 5px;
  height: 80%;
  width: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.register-submit{
  border:none;
  border-radius: 2px;
  background: wheat;
  margin: 10px;
  width: 74%;
  padding: 12px 0px;
  color: black;
}
.login-submit:hover{
  background: gray;
  cursor: pointer;
}
.login-form{
  width: 80%;
}
.register-section h2{
  margin-bottom: 10px;
}
/* register */
</style>
</head>

<body>
       <section class="main">
       <div class="register-section">
         <h2 style="color: wheat; background-color:olive;">Registeration</h2>

         <div class="login-form">
           <form action="" method="post">
           <table align="center" class="table">
            <tr><td> <h4><b style="color: wheat;">Name:</b></h4></td>
           <td><input class="login-input" type="text" name="name" placeholder="Name"></td></tr>

           <tr><td> <h4><b style="color: wheat;">Last Name:</b></h4></td>
           <td><input class="login-input" type="text" name="surname" placeholder="Last Name"></td></tr>

           <tr><td> <h4><b style="color: wheat;">Email:</b></h4></td>
           <td><input class="login-input" type="text" name="email" placeholder="E-mail"></td></tr>

           <tr><td> <h4><b style="color: wheat;">Password:</b></h4></td>
           <td><input class="login-input" type="password" name="password" placeholder="Password"></td></tr>
           
           <tr><td> <h4><b style="color: wheat;">Last Name:</b></h4></td>
           <td><input class="login-input" type="password" name="password-repeat" placeholder="Repeat Password"></td></tr>
        
           <tr><td colspan='2'>
           <input class="register-submit" type="submit" name="login-submit" value="Submit"></td></tr>
</table></form>
         </div>
         <p class="password-change-info"><?php echo $msg; ?></p>
         <p class="login-p" style="color: #fff; font-size:20px;">Registered? <a href="login.php" style="color: wheat; background-color:olive;">SignIn</a></p>
       </div>
     </section>
    
</body>
</html>

<?php
/**
* user registration process and entering information into the database
*/
if(!empty($_POST['name']) and !empty($_POST['surname']) and !empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['password-repeat']))
{
  openConnection();
  global $serwer;

    if($_POST['password-repeat'] == $_POST['password']){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password-repeat'];
    $query = "INSERT INTO `user` (`name`, `surname`, `email`, `password`) VALUES ('$name', '$surname', '$email', '$password');";
    mysqli_query($serwer, $query);
    closeConnection();
    /**
    * If registration is successful, you will be redirected to the login page
    */
    header("Location: login.php?msg=2");
  }
  else
  {
    header("Location: register.php?msg=1");
  }
}
else{
}
 ?>
