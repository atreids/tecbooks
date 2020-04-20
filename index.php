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
    include("./inc/footer.php");
    ?>
    <!-- Includes universal footer -->
</body>

</html>