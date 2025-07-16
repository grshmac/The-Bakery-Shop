<?php
// Displaying login status or success message after registration
include('head2.php');
include('connection.php');
session_start();

if (isset($_SESSION["UserID"]) || isset($_SESSION["EmployeeID"])) {
  echo '<script>window.location="index.php"</script>';
}

$msg = "";
if (isset($_GET['msg'])) {
  if ($_GET['msg'] == 1) {
    $msg = "Incorrect login credentials!";
  } elseif ($_GET['msg'] == 2) {
    $msg = "You have successfully registered your username! You can now log in.";
  }
}
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <style>
    .main {
      font-family: 'Poppins', sans-serif;
      height: 100%;
      width: 100%;
      background-image: linear-gradient(rgba(4,9,30,0.7), rgba(4,9,39,0.7)), url(imagesbake/banner6.jpg);
      background-position: center;
      background-size: cover;
      position: fixed;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-section {
      border-radius: 5px;
      height: 55%;
      width: 40%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .login-section h2 {
      margin-bottom: 30px;
    }
    .login-form {
      width: 80%;
    }
    .login-input {
      border: none;
      width: 70%;
      margin: 7px;
      background: gainsboro;
      padding: 10px 10px;
      border-radius: 2px;
    }
    .login-submit {
      border: none;
      border-radius: 2px;
      background: wheat;
      margin: 10px;
      width: 70%;
      padding: 12px 0px;
      color: black;
      transition: all 0.1s ease-out;
    }
    .login-submit:hover {
      background: gray;
      cursor: pointer;
    }
    .login-form form {
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
      <h2 style="color: wheat; background-color:olive;">Login</h2>
      <div class="login-form">
        <form method="POST">
          <table align="center" class="table">
            <tr>
              <td><h2><b style="color: wheat;">Email id:</b></h2></td>
              <td><input class="login-input" type="text" name="email" placeholder="E-mail"></td>
            </tr>
            <tr>
              <td><h2><b style="color: wheat;">Password:</b></h2></td>
              <td><input class="login-input" type="password" name="password" placeholder="Password"></td>
            </tr>
            <tr>
              <td colspan='2'>
                <center><input class="login-submit" type="submit" name="login-submit" value="Sign In"></center>
              </td>
            </tr>
          </table>
        </form>
      </div>
      <p style="color:purple;"><?php echo $msg; ?></p>
      <p style="color: #fff; font-size:20px;">Don't have an account?
        <a href="register.php" style="color: wheat; background-color:olive;"><b>Register</b></a>
      </p>
    </div>
  </section>
</body>
</html>

<?php
if (!empty($_POST['email']) && !empty($_POST['password'])) {
  openConnection();
  global $conn;

  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT UserID, Password FROM user WHERE email = '$email'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['Password'] === $password) {
      $_SESSION["UserID"] = $row['UserID'];
      header('Location: index.php');
      exit;
    }
  }

  // If login fails
  header('Location: login.php?msg=1');
  closeConnection();
}
?>
