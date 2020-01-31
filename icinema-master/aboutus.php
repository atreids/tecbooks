<?php
session_start();
?>


<!doctype html>
<html lang="en">
  <head>
    <!--Basic Header-->
    <?php
      include("./inc/header.php");
    ?>
    <title>About Us</title>
  </head>
  <body>
    <!--Includes-->
    <?php
      include("./inc/navbar.php");
      include("./inc/footer.php");
    ?>
    <!--Content-->
    <div class="container">
      <h2>About Us</h2>
      <?php
        include("./inc/aboutus.html");
      ?>
    </div>
  </body>
</html>