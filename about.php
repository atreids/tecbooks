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
    <div class="container margin-top-lg margin-bottom">
        <h2>About Tecbooks</h2>
        <p>Tecbooks is an specialist bookstore in technology and educational books for all ages.</p>
        <img class="img-fluid" src="./img/reading.jpg">
    </div>

    <?php include("./inc/generic_footer.php");?>
</body>

</html>