<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bakery</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.56, maximum-scale=3.0, minimum-scale=0.46">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <style>
    .header{
    background: black;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding:1.5rem 10%;
    border-bottom: var(--border);
    position: fixed;
    top:0; left: 0; right: 0;
    z-index: 1000;
    
}

.header .logo img{
    height:5rem;
    margin-left: 15px;
    margin-right: 15px;
}

.header .navbar a{
    margin:0px 15px;
    font-size: 1.7rem;
    color:#fff;
    padding: 0.5rem 0%;
}

.header .navbar a:hover{
    color:var(--main-color);
    border-bottom: .1rem solid var(--main-color);
    padding-bottom: .5rem;
}

.header .navbar{
    margin:0px 15px;
    height: 60px;
}

.header .navbar a{
    cursor: pointer;
    margin-left: 2rem;
  }
.header .navbar a:first-child{
    margin-left: 5rem;
  }

  </style>
</head>

<body>
  <header class="header">
    <nav class="navbar justify-content-center">
        <a href="index.php">Home</a>

        <a href="#" class="logo">
            <img src="imagesbake/logo3.avif" alt="">
        </a>

    </nav>
</header>
</body>
</html>
