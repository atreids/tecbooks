<?php
session_start();
require("./inc/connection.php");

if(!isset($_SESSION['login'])){
    header("location: ./index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php 
        include("./inc/header.php");
    ?> <!-Includes basic header->
        <script src="https://kit.fontawesome.com/6c30bf13b8.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="./css/style.css">
        <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/navbar.php");?>
    <!-- Includes universal navbar -->

    <div class="container redbackground">
        <div class="inner-container">
            <h2>Welcome to your account page</h2>
        </div>
    </div>

    <div id="para3" class="img-3 parrallax short-height">
    </div>

    <div class="container navybackground">
        <div class="inner-container med-height navybackground">
            <div class="col">
                <h3>Edit details:</h3>
                <ul class="btn-list">
                    <li class="btn btn-active">Update Details</li>
                    <li class="btn">Update Payment</li>
                    <li class="btn">Update Addresses</li>
                </ul>
            </div>
            <div class="col">
                Insert details here
            </div>
        </div>
    </div>

    <div class="border-red"></div>

    <div class="container navybackground">
        <div class="inner-container med-height navybackground">
            <div class="col">
                <h3>We all read a little different</h3>
                <p>But no matter how you read, we are here to help to get you your books on-time and
                    at a great price! Leaving you more time for that next chapter!
                </p>
            </div>
            <div class="col">
                <img src="./img/help.jpg" class="circle vsm-img">
            </div>
        </div>
    </div>
    <?php include("./inc/footer.php");?>
    <!-- Includes universal footer -->
</body>

</html>