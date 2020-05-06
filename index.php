<!--
Developed by Aaron Donaldson.
For educational purposes.
contact at ec1823622@edinburghcollege.ac.uk

This is the index page
-->

<?php
session_start(); 
include("./php/connection.php"); #Includes connection to database, $db is the mysqli link
?>

<!doctype html>
<html lang="en">

<head>
    <!-- includes necessary meta tags and other data -->
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks</title>
</head>

<body class="d-flex flex-column">

    <!-- Includes the navbar -->
    <?php include("./inc/nav.php");?>

    <!-- This is the parrallax image and landing text -->
    <div class="container-fluid parrallax img-1 center-flex lander-height">
        <div class="center-flex"><span id="lander"><em>TecBooks</em></span></div>
    </div>

    <!-- cards.php displays a bunch of books from the database -->
    <?php include("./inc/cards.php");?>

    <!--This is the little cute message at the bottom of the page -->
    <div class="container margin-top-lg margin-bottom">
        <div class="row">
            <div class="col-sm center-flex flex-column">
                <h2><em>“A reader lives a thousand lives before he dies . . . The man who never reads lives only
                        one.”</em> –
                    George R.R. Martin</h2>
                <p>We all love to read here at Tecbooks. That's why we are dedicated to providing an educational
                    treasure trove to the next generation of readers.</p>
            </div>
            <div class="col-sm">
                <img src="./img/bookstore2.jpg" class="parrallelogram sm-img">
            </div>
        </div>

        <!-- Some needed <script></script> tags -->
        <?php include("./inc/generic_footer.php");?>
</body>

</html>