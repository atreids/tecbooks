<?php
session_start();
include("./inc/connection.php");
?>

<!doctype html>
<html lang="en">

<head>
    <?php require("./inc/header.php");?>
</head>

<body>
    <?php
        include("./inc/navbar.php");
    ?>

    <div class="container-fluid parrallax img-2 med-height center-text" style="flex-flow:column;">
        <div class="row row-no-gutters">
            <div class="col"><span id="lander"><em>Books For The Mind And Soul</em></span></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row center-text">
            <form>
                <input type="text" class="search" placeholder="Search...">
            </form>
        </div>
    </div>

    <?php 
    include("./inc/card.php");
    ?>
    <div class="divider"></div>
    <div class="container-fluid med-height buffer-top">
        <div class="row flex-centered">
            <div class="col-sm-6 padding-left">
                <h3 class="bottom-h">We all read a little differently</h3>
                <p class="bottom-para">But no matter how you read, we are here to help to get you your books on-time and
                    at a great price! <br>Leaving you more time for that next chapter!
                </p>
            </div>
            <div class="col-sm-6 hide-small">
                <img src="./img/bookstore2.jpg" class="parrallelogram sm-img">
            </div>
        </div>
    </div>
    <?php include("./inc/footer.php");?>
    <!-- Includes universal footer -->
</body>

</html>