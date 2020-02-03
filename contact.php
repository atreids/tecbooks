<?php
session_start();
include("./inc/connection.php");
?>


<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/header.php");?>
    <!-- Includes universal header -->
    <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/navbar.php");?>
    <!-- Includes universal navbar -->

    <div class="container redbackground">
        <div class="inner-container">
            <h1>Contact Us</h1>
        </div>
    </div>


    <div id="para2" class="img-2 parrallax short-height">
    </div>

    <div class="container navybackground">
        <div class="inner-container navybackground med-height">
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
    <?php include("./inc/footer.php");?>
    <!-- Includes universal footer -->
</body>

</html>