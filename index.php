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
</head>

<body>
    <div class="container-fluid center">
        <h1 class="title">TecBooks</h1>
    </div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="./index.php">HOME</a></li>
                    <li><a href="#">BESTSELLERS</a></li>
                    <li><a href="#">MATHEMATICS</a></li>
                    <li><a href="#">COMPUTER SCIENCE</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            CATEGORIES</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">NEW</a></li>
                            <li><a href="#">BIOLOGY</a></li>
                            <li><a href="#">ARCHITECTURE</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-right">
                    <div class="form-group"><input type="text" class="form-control" placeholder="Search"></div>
                    <button type="submit" class="btn btn-default">SEARCH</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if(isset($_SESSION['login'])){
                            echo '<li><a href="./inc/cart.php">Cart</a></li>';
                            echo '<li><a href="./inc/logout.php">Logout</a></li>';
                        } else {
                            echo '<li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>';
                        };
                    ?>
                </ul>
            </div>
            <!--End of navbar collapse-->
        </div>
    </nav>

    <div class="parralax img-1"></div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./node_modules/dist/jquery.min.js"></script>
    <!-- Bootstrap precompiled js -->
    <script src="./js/bootstrap.js"></script>
    <!-- Latest compiled and minified JavaScript -->
</body>

</html>