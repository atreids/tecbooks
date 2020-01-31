<?php
session_start();
require("./inc/connection.php");

$query = "SELECT images FROM movies WHERE";
$result = mysqli_query($db,$query);
?>

<!doctype html>
<html lang="en">
  <head>
    <!--Includes basic header-->
    <?php require("./inc/header.php"); ?>
    <link rel="stylesheet" href="../css/index.css">
    <title>iCinema</title>
  </head>

  <body>

    <!--Includes content-->
    <?php 
      ini_set('display_errors', 1);
      error_reporting(E_ALL|E_STRICT);
      include("./inc/navbar.php");
      include("./inc/cards.php");
      include("./inc/footer.php");
    ?>

    
  </body>
</html>