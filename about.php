<!--
Developed by Aaron Donaldson.
For educational purposes.
contact at ec1823622@edinburghcollege.ac.uk


This is just a small about page for Tecbooks
-->
<?php
session_start();
require("./php/connection.php"); #Connection to database, $db is linking variable
?>

<!doctype html>
<html lang="en">

<head>
    <!--generic header contains all regular meta information and other info needed on every page-->
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks | About</title>
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