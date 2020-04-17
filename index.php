<?php
session_start();
include("./inc/connection.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TecBooks</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">

    <script src="https://kit.fontawesome.com/6c30bf13b8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Martel+Sans|Pacifico&display=swap" rel="stylesheet">
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