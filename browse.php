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

    <div class="container-fluid">
        <div class="row center-text">
            <form>
                <input type="text" class="search" placeholder="Search...">
            </form>
        </div>
    </div>
    <div class="container-fluid panel buffer-top">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="..." alt="...">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#"
                                class="btn btn-default" role="button">Button</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
include("./inc/footer.php");
?>
</body>

</html>