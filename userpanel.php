<?php
/* displaying information if the data or password change was successful */
include('connection.php');
session_start();

if(!isset($_SESSION["UserID"])) {
    header('Location: index.php');
    exit();
}

$messageID = $_GET['message'] ?? 0;

switch ($messageID) {
    case 1: $message = "Password has been changed!"; break;
    case 2: $message = "User details have been changed!"; break;
    default: $message = ""; break;
}

openConnection();
global $conn;

try {
    $stmt = mysqli_prepare($conn, "SELECT Name, Surname, email FROM user WHERE UserID = ?");
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION["UserID"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $name, $surname, $email);
    if (mysqli_stmt_fetch($stmt)) {
        $_SESSION["name"] = $name . " " . $surname;
        $_SESSION["email"] = $email;
    } else {
        session_destroy();
        closeConnection();
        header('Location: login.php');
        exit();
    }
    mysqli_stmt_close($stmt);
} catch (Exception $e) {
    session_destroy();
    closeConnection();
    header('Location: login.php');
    exit();
}

closeConnection();
?>

<html>
<head>
    <meta charset="utf-8">
    <title>User Panel</title>
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
</section>

<section class="main">
    <div class="userpanel-section">
        <h2>Account information</h2>
        <h3>First name and last name</h3>
        <p><?=htmlspecialchars($_SESSION["name"])?></p>
        <h3>E-mail address</h3>
        <p><?=htmlspecialchars($_SESSION["email"])?></p>
        <p class="p-info"><?=htmlspecialchars($message)?></p>
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
