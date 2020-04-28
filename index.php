<?php
session_start();
require("./php/connection.php");
?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks</title>
</head>

<body class="d-flex flex-column">
    <?php include("./inc/nav.php");?>
    <div class="container-fluid parrallax img-2 center-flex lg-height">
        <div class="center-flex"><span id="lander"><em>Books For The Mind And Soul</em></span></div>
    </div>
    <?php include("./inc/cards.php");?>

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

        <?php include("./inc/generic_footer.php");?>
</body>

</html>