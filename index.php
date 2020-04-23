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

<body>
    <?php include("./inc/nav.php");?>
    <div class="container-fluid parrallax img-2 center-flex med-height">
        <div class="center-flex"><span id="lander"><em>Books For The Mind And Soul</em></span></div>
    </div>
    <?php include("./inc/cards.php");?>

    <?php include("./inc/generic_footer.php");?>
</body>

</html>