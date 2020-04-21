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

    <div class="container-fluid center-text">
        <?php include("./inc/paypal.php");?>
    </div>
    <?php include("./inc/footer.php");?>
</body>

</html>