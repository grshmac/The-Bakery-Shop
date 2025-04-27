<?php 
include('connection.php');
openConnection();
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
          <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="Wyloguj się"></a>
        </ul>
        </div>
      </nav>
    </section>
    <form method=GET>
      <section class="portal-main">
        <div class="cart-box">
          <h2>Basket</h2>
          <ul>
            <li>
              <div class="column-cart">
                <p>Photo</p>
              </div>
              <div class="column-cart">
                <p>Name</p>
              </div>
              <div class="column-cart">
                <p>Price</p>
              </div>
              <div class="column-cart">
                <p>Quantity in order</p>
              </div>
              <div class="column-cart">
                <div class="buttons-list">

                <?php
                //adding the appropriate button depending on whether we are in the basket or editing it
                if(isset($_GET["action"]) && $_GET["action"] == "edit"){
                echo '<button class="quantity-save-button" type=submit name=button>Save</button>';
                }
                else echo '<a class="quantity-edit-button" href="cart.php?action=edit">Edit quantity</a>';
                ?>

              </div>
              </div>
            </li>

              <?php
                session_start();
                //checking whether the user is logged in
                if(!isset($_SESSION["UserID"])) {
                  header('Location: login.php');
                }
                if(isset($_SESSION['cart'])) {
                $price = 0;
                $_SESSION['fullprice'] = 0;
                //displaying all products in the cart
              	foreach($_SESSION['cart'] as $value)
                {
                echo'
                  <li>
                 <div class="column-cart">
                   <img src="icons/'.$value['ImageID'].'" alt="'.$value['Hashtag'].'">
                 </div>
                 <div class="column-cart">
                   <p><b>'.$value['Name'].'</b></p>
                 </div>
                 <div class="column-cart">
                 <p>'.$price = (double)$value['Price'] * (double)$value['Quantity'].' NPR</p>
                 </div>';
                 $_SESSION['fullprice'] = $_SESSION['fullprice'] + (double)$price;
                 if(isset($_GET["action"]) && $_GET["action"] == "edit"){
                  echo'
                <div class="column-cart">
                <input class="cart-quantity" type="number" min="1" max='.$value['AmountOnStock'].' name="amount['.$value['ProductID'].']" value='.$value['Quantity'].'>
                </div>';
                }
                else {
                  echo'
                <div class="column-cart">
                <p>'.$value['Quantity'].'</p>
                </div>';
              }
                 echo'
                 <div class="column-cart">
                 <div class="buttons-list">
                   <a class="cart-links" href="cart.php?action=delete&id='.$value['ProductID'].'">Delete</a>
                 </div>
                 </div>
               </li>
                  ';
              	}}
                if(!isset($_SESSION['fullprice'])){
                  $_SESSION['fullprice'] = 0;
                }
               ?>
             </ul>

             <div class="final-cart">
               <div class="total">
                 <p>Total order price: </p>
                 <p id="total-price"><?=$_SESSION['fullprice']?>NPR</p>
                 <button type="submit" name="add" class="cart-links"><a href="success.php">Order</a></button>
               </div>

              <div>
							<h3>Pay With</h3>
							<ul>
								<li>
									<form action="https://uat.esewa.com.np/epay/main" method="POST">
										<input value="<?php echo $value['Price'];?>" name="tAmt" type="hidden">
										<input value="0" name="txAmt" type="hidden">
										<input value="0" name="psc" type="hidden">
										<input value="0" name="pdc" type="hidden">
										<input value="epay_payment" name="scd" type="hidden">
										<input value="<?php echo $product['ProductID'];?>" name="pid" type="hidden">
										<input value="http://localhost/bake/success.php" type="hidden" name="su">
										<input value="http://localhost/bake/failure.php" type="hidden" name="fu">
										<input type="image" src="icons/esewa.png">
										</li>	
									</ul>
						</div>	

        </div>
        </div>
    </section>
    </form>

      <?php
      //triggering functions after pressing the appropriate buttons
      if(isset($_GET["button"])){
        updateQuantity($_GET['amount']);
      }
      if(isset($_GET["add"])){
        addOrder();
      }
      if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
          //searching the cart to find the product ID to remove
          foreach($_SESSION['cart'] as $key => $value){
            if($value["ProductID"] == $_GET["id"]){
              //deleting a found product
              unset($_SESSION['cart'][$key]);
              echo '<script>window.location="cart.php"</script>';
            }
          }
        }
      }

      //function responsible for changing the number of ordered products in the basket
      function updateQuantity($val){
        if(isset($val)){
          foreach($_SESSION['cart'] as $key => $value){
            //przeszukiwanie koszyka i zmienianie ilości dla każdego produktu na tą która
            //jest podana w input odpowiedzialnym za wpisywanie nowych ilosci podczas edytowania koszyka
              if($value["ProductID"] == key($val)){
                if($val[key($val)]>$value["AmountOnStock"]){
                  echo '<script>alert("Nie ma tylu produktów -'.$value["Name"].'- w magazynie, maksymalna możliwa ilość na ten moment wynosi: '.$value["AmountOnStock"].'")</script>';
                }
                else{
                  //zamiana wartości w ilościach w koszyku z wartością podaną w input
                  $value["Quantity"] = $val[key($val)];
                  $_SESSION['cart'][$key] = $value;
                }
            }
            //przechodzenie do nastepnego inputa
            if(($next = next($val)) == null) break;
          }
          echo '<script>window.location="cart.php"</script>';
        }
      }

      //funkcja odpowiedzialna za dodwanie zawartości koszyka do tabeli w bazie danych
      function addOrder(){
        global $serwer;
        //sprawdzanie czy użytkownik jest zalogowany i czy koszyk został utworzony
        if(isset($_SESSION["UserID"]) && isset($_SESSION["cart"])){
            $userid = $_SESSION["UserID"];
            //pobieranie numerów zamówienia dla wybranego użytkownika z bazy, od największego do najmniejszego
            $getNextOrderNumber = mysqli_query($serwer, "SELECT OrderNumber FROM `order` WHERE UserID=$userid ORDER BY OrderNumber DESC");

            //ustawianie numeru zamówienia na jeden wyższy niż największy który wystepuje w bazie
            //gdyby numer zamówienia jeszcze nie istniał to zostanie on ustawiony na 1
            $nextOrderNumber = mysqli_fetch_row($getNextOrderNumber);
            $nextOrderNumber = $nextOrderNumber[0]+1;

            mysqli_free_result($getNextOrderNumber);
            //przechodzenie po koszyku i dodawanie każdej pozycji do tabeli "order"
            foreach($_SESSION['cart'] as $value){
                $price = (double)$value['Price'];
                $query = "INSERT INTO `order` (`ordernumber`, `userid`, `productid`, `quantity`, `price`)
                VALUES ('$nextOrderNumber', '$userid', '$value[ProductID]', '$value[Quantity]', '$price');";
                mysqli_query($serwer, $query);
                //ustawianie nowego stanu ilości produktów 
                $getAmount = mysqli_query($serwer, "SELECT AmountOnStock FROM `product` WHERE ProductID=$value[ProductID]");
                $oldAmount = mysqli_fetch_row($getAmount);
                $newAmount = $oldAmount[0] - $value['Quantity'];
                mysqli_query($serwer, "UPDATE `product` SET `AmountOnStock`=$newAmount WHERE ProductID=$value[ProductID]");
            }
            //czyszczenie koszyka i całkowitej ceny zamówienia
            unset($_SESSION['cart']);
            unset($_SESSION['fullprice']);
        }
        echo '<script>window.location="cart.php"</script>';
    }
    closeConnection();
      ?>
  </body>
</html>
