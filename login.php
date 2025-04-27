<!-- User Login -->
<?php
/**
* displaying information if login failed or user was successfully registered
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
  $msg = "Nieprawidłowe dane logowania!";
}
else if($messageID == 2)
{
  $msg = "Pomyślnie zarejstrowano użytkownika! Można się teraz zalogować.";
}
else{
  $msg = "";
}
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
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
/* login */
</style>

</head>
  <body>
      <section class="main">
      <div class="login-section">
        <h2 style="color: wheat; background-color:olive;">Login</h2>
        
        <div class="login-form">
          <form method=POST action="">
          <table align="center" class="table">
            <tr>
         <td> <h2><b style="color: wheat;">Email id: </b></h2></td>
         <td> <input class="login-input" type="text" name="email" placeholder="E-mail"></td>
</tr>
<tr>
                    <td>
                        <h2><b style="color: wheat;">Password: </b></h2>
                    </td>
          <td><input class="login-input" type="password" name="password" placeholder="Password"></Td></tr>
          <tr><td colspan='2'>
          <center><input class="login-submit" type="submit" name="login-submit" value="Sign In"></center>
</td></tr></table>
        </form>
        </div>

        <p style="color:purple;"><?php echo $msg; ?></p>
        <p class="login-p" style="color: #fff; font-size:20px;">Don't have an account?<a href="register.php" style="color: wheat; background-color:olive;"><b>Register</b></a></p>
      </div>

    </section>
</body>
</html>

<?php
/**
* proces logowania uzytkownika wedlug informacji z bazy danych
*/
if(!empty($_POST['email']) and !empty($_POST['password']))
{
  openConnection();
  global $serwer;

  //pobieranie podanych wartości
  $email = $_POST['email'];
  $password = $_POST['password'];

  //pobieranie hasła użytkownika z bazy dla podanego emaila
  $getPassword = mysqli_fetch_array(mysqli_query($serwer, "SELECT Password FROM user WHERE email = '$email'"));
  $userPassword = $getPassword[0];

  //porównywanie podanego hasła z hasłem z bazy
  if($password == $userPassword)
  {
    $getInfo = mysqli_fetch_array(mysqli_query($serwer, "SELECT UserID FROM user WHERE email = '$email'"));
    /**
    * rozpoczecie sesji dla zalogowanego uzytkownika i przekierowanie na strone glowna
    */
    $_SESSION["UserID"] = $getInfo[0];
    header('Location:index.php');
  }else {
    header('Location:login.php?msg=1');
  }
  closeConnection();
}
else {
}
 ?>
