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
    <div class="container-fluid divider"></div>
    <div class="container">
        <h2>About Tecbooks</h2>
    </div>

    <?php include("./inc/generic_footer.php");?>
</body>

</html>