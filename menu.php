<?php
include('connection.php');
session_start();

// Redirect employee to index page
if (isset($_SESSION["EmployeeID"])) {
    header('Location: index.php');
    exit();
}

// Handle message display
$messageID = $_GET['msg'] ?? 0;
$msg = "";
switch ($messageID) {
    case 1: $msg = "The product has been added to the cart!"; break;
    case 2: $msg = "Unable to add product!"; break;
}

// Handle adding product to cart if POSTed
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button']) && isset($_SESSION["UserID"])) {
    $productId = key($_POST['button']);
    $action = $_POST['button'][$productId] ?? '';
    if ($action === "Add") {
        addToCart($productId, 1);
        // Redirect to avoid resubmission
        header('Location: menu.php?msg=1');
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION["UserID"])) {
    // Not logged in, redirect to login
    header('Location: login.php');
    exit();
}

openConnection();
global $conn;

$query = "SELECT ImageID, Name, Price, Hashtag, ProductID, AmountOnStock FROM product";
$result = mysqli_query($conn, $query);
if (!$result) {
    // Handle query failure gracefully
    die("Database query failed.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Menu</title>
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
                <?php if (isset($_SESSION["UserID"])): ?>
                    <li><a class="menu-link" href="userpanel.php">AccInfo</a></li>
                    <li><a class="menu-link" href="orderhistory.php">Wishlist</a></li>
                    <li><a class="menu-link" href="cart.php">Basket<span class="material-symbols-outlined">shopping_basket</span></a></li>
                <?php else: ?>
                    <li><a class="menu-link" href="adminlogin.php">Admin</a></li>
                    <li><a class="menu-link" href="login.php">Basket<span class="material-symbols-outlined">shopping_basket</span></a></li>
                    <li><a class="link-button" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php if (isset($_SESSION["UserID"])): ?>
            <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="log out"></a>
        <?php endif; ?>
    </nav>
</section>

<section class="banner">
    <h1>Menu</h1>
</section>

<section class="menu">
    <p class="info-menu"><?= htmlspecialchars($msg) ?></p>
    <div class="menu-list">
        <form class="menu-list-form" method="POST" action="menu.php">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php if ($row['AmountOnStock'] > 0): ?>
                    <div class="product">
                        <a href="product_description.php?id=<?= (int)$row['ProductID'] ?>">
                            <img src="icons/<?= htmlspecialchars($row['ImageID']) ?>" alt="<?= htmlspecialchars($row['Hashtag']) ?>">
                            <p class="title-product"><?= htmlspecialchars($row['Name']) ?></p>
                            <p class="price-product"><?= number_format($row['Price'], 2) ?> NPR</p>
                        </a>
                        <button class="add-button" type="submit" name="button[<?= (int)$row['ProductID'] ?>]" value="Add">add to cart</button>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </form>
        <?php mysqli_free_result($result); ?>
    </div>
</section>

<section class="footer">
    <div class="column-footer">
        <a href="index.php"><img class="logo" src="imagesbake/logo3.avif" alt="Bake Logo"></a>
    </div>
    <div class="column-footer">
        <p>Location:<br><i>DurbarMarg<br>03-330 TreeHouse</i></p>
    </div>
    <div class="column-footer">
        <p>Contact:<br><i>01462718<br>thebakeryhouse@gmail.com</i></p>
    </div>
    <div class="column-footer"></div>
</section>

<?php closeConnection(); ?>
</body>
</html>
