
<html>
  <head>
    <meta charset="utf-8">
    <title>Bakery</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="index2.css">
<style>
.footer{
  display: flex;
  background: black;
  flex-direction: row;
  width: 100%;
  height: 110px;
  padding: 30px 0;
  align-items: center;
  justify-content: space-around;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.column-footer{
  display: flex;
  width: 55%;
  text-align: left;
  align-items: center;
  flex-direction: column;
}
.column-footer p{
font-size: large;
  color: white;
  display: block;
}
.footer .share{
  padding:5rem 0;
}
.footer .share a{
  height: 3rem;
  width: 3rem;
  line-height: 3rem;
  font-size: 1.5rem;
  color:#fff;
  border:var(--border);
  margin:.3rem;
  border-radius: 50%;
}
.footer .share a:hover{
  background-color: var(--main-color);
}
.logo{
  width: 110px;
  margin: 0px;
}
</style>
</head>

  <body>
    <header class="header">
      <nav class="navbar" justify-content-center>
      <a href="index.php"><img src="imagesbake/logo3.avif" alt="Donut House Logo" height="65rem"></a>
      <div class="nav-links" id="navLinks">
      <ul>
      <li><a class="menu-link" href="index.php">Home</a></li>

      <li><a href="#about">About</a></li>
      <li><a href="#review">review</a></li>
      <li><a href="#contact">contact</a></li>

      <!-- <div class="logo">
            <img src="imagesbake/logo3.avif" alt="Bake">
      </div> -->

        <?php
        /**
        * creating navigation elements on the page depending on whether the session is for a logged in user, a logged in user or an employee
        */
        session_start();
        if(isset($_SESSION["UserID"])){
          echo '
          <li><a class="menu-link" href="menu2.php">Menu</a></li>
          <li><a class="menu-link" href="userpanel.php">AccInfo</a></li>
          <li><a class="menu-link" href="orderhistory.php">Wishlist</a></li>
          <li><a class="menu-link" href="cart.php">Basket<span class="material-symbols-outlined">shopping_basket</span></a></li>
          </ul>
          </div>
          <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="log out"></a>';
        }
        else if(isset($_SESSION["EmployeeID"])){
          echo '<li><a class="menu-link" href="employeeportal.php">Product list</a></li>
          <li><a class="menu-link" href="employeeportal_addproduct.php">Add a new product</a></li>
          <li class="username">'.$_SESSION["EmployeeName"].'</li>
          </ul>
          </div>
          <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="Logout"></a>';
        }
        else{
          echo '
          <li><a class="menu-link" href="menu2.php">Menu</a></li>
          <li><a class="menu-link" href="adminlogin.php">Admin</a></li>
          <li><a class="menu-link" href="login.php">Basket<span class="material-symbols-outlined">shopping_basket</span></a></li>
          <li><a class="link-button" href="login.php">Login</a></li>
          </ul>
          </div>';
        }
        ?>
      </nav> 
    </header>

    <!-- home section starts  -->

<section class="home justify-content-lg-start" id="home">
    <div class="content">
        <h3>Fresh Bakes Anywhere, Anytime</h3>
        <p>Nestled in the heart of Greenwood,
            we provide baked goods using premium, locally sourced organic ingredients
            to create a unique and delightful culinary experience for our customers.
        </p>
        <a href="login.php" class="btn">get yours now</a>
    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about" >
    <h1 class="heading"> <span>About</span> Us</h1>
    <div class="row g-0">
        <div class="image">
            <img src="imagesbake/specials/cupcakes.jpg" alt="" class="img-fluid">
        </div>
        <div class="content">
            <h3>Welcome to The Bakery Shop</h3>
            <p>
                The Bakery Shop is a existing bakery service specializing in an array of handcrafted pastries, cakes, 
                and bread. We endeavor to provide family of our customers with safe, appetizing, nutritious and quality cakes at reasonable prices.
                We are committed to providing superior quality and unparalleled bakery products through our talented team of chefs and cutting edge techniques. 
                We are internally aligned and externally focused to provide outstanding customer service and believe that customer satisfaction is our ultimate goal.
            </p>
            <p>
              We are committed to providing superior quality and unparalleled bakery products through our talented team of chefs and cutting edge techniques. 
              We are internally aligned and externally focused to provide outstanding customer service and believe that customer satisfaction is our ultimate goal.
            </p>
        </div>
    </div>
</section>

<!-- about section ends -->

<!-- review section starts  -->

<section class="review" id="review">

    <h1 class="heading"> customer's <span>review</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>"I ordered some cookies and croissants. So fresh and delicious. 
                Now, I cant live without ordering at least 3 days a week for my sweet morning."</p>
            <img src="imagesbake/customers/hobi.jpg" class="user" alt="">
            <h3>Jung Hoseok</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>"The delivery is always so quick and assuring thus making my orders fresh and lovely all the time. Cant wait to ordr more!"</p>
            <img src="imagesbake/customers/sohe.jpg" class="user" alt="">
            <h3>Han Sohee</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>
        
        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>"My god, what a beautiful way to ice the cakes with all the strawberries and toppings. I am a big fan of the Eclaires. Keep up the good work."</p>
            <img src="imagesbake/customers/Screenshot 2024-03-23 141507.png" class="user" alt="">
            <h3>Donald Trump</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

    </div>

</section>

<!-- review section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">
    <h1 class="heading"><span>Contact</span> Us</h1>
    <div class="row">
        <div id="map" class="map pull-left"></div>
        <form name="contact" method="POST" action="https://formspree.io/f/xayzavgb">
            <h3> Get in touch with us!</h3>
            <div class="inputBox">
                <span class="fas fa-envelope"></span>
                <input type="email" name="email" placeholder="Email Address">
            </div>
            <div class="inputBox">
                <textarea name="message" placeholder="Enter your message..."></textarea>
            </div>
            <button type="submit" class="btn">Contact Now</button>
        </form>
    </div>
</section>

<!-- contact section ends -->

<!-- footer section starts  -->

<!-- <section class="footer">
    
    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        <a href="#" class="fab fa-pinterest"></a>
    </div>

    <div class="links">
        <a href="#">home</a>
        <a href="#">about</a>
        <a href="#">menu</a>
        <a href="#">products</a>
        <a href="#">review</a>
        <a href="#">contact</a>
    </div>

    <div class="credit">THE BAKERY SHOP</div>

</section> -->
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
    <div class="column-footer">
    </div>
    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
    </div>
  </section>

<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>