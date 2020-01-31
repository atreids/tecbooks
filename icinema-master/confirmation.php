<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!--Includes basic header-->
    <?php require("./inc/header.php"); ?>
    <title>Success!</title>
  </head>

  <body>

    <!--Includes content-->
    <?php 
      include("./inc/navbar.php");
      include("./inc/footer.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Success!</h1> 
                <?php
                            if(isset($_GET['psucc'])) {
                                $tickets = $_GET['ptickets'];
                                $movie = $_GET['pmovie'];
                                echo '<h2 style="margin-top:2px;"> '.$tickets.' tickets purchased for '.$movie.'</h2>';
                            }
                        ?>
                <h4>You can now return to the home screen</h4>
            </div>
        </div>
    </div>
    
  </body>
</html>