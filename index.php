<?php
session_start();
require("./inc/connection.php");
#This PHP starts the session when the page is loaded and includes the connection to the database
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--font awesome script for icons-->
    <script src="https://kit.fontawesome.com/6c30bf13b8.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Martel+Sans|Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Tecbooks</title>
</head>

<body>
    <nav>
        <a href="index.php" class="logo">Tecbooks</a>
        <a href="#" class="nav-link">Link</a>
        <a href="#" class="nav-link">Link</a>
        <a href="#" class="nav-link">Link</a>
        <a href="#" class="nav-link">Link</a>
    </nav>
    <div id="para1" class="img-1 parrallax center-text med-height">
        <span id="lander">Books for nerds</br> By nerds</span>
    </div>

    <div class="container books">
        <div class="inner-container">
            <div class="card book">
                <div class="placeholder-img"></div>
                <p>Author: Here</p>
                <p>ISBN: Here</p>
                <p>Price: Here</p>
                <button class="btn-book opacity-low">Add to Cart</button>
            </div>
        </div>
    </div>

    <div id="para2" class="img-2 parrallax short-height">
    </div>

    <div class="container story">
        <div class="inner-container story flex flow-right flex-even flex-nowrap">
            <div class="col">
                <h2>Our Mission:</h2>
                <p>We are a small, family-owned, independent bookstore based out of Edinburgh, Scotland.
                    We hope to inspire the world to read, from our small cosy shop just off of Edinburgh's historic
                    royal mile.
                </p>
            </div>
            <div class="col">
                <img src="./img/bookstore.jpg" class="parrallelogram sm-img">
            </div>
        </div>
    </div>
</body>

</html>