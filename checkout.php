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

    <?php include("./php/paypal.php");?>

    <?php include("./inc/generic_footer.php");?>
</body>

</html>