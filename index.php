<?php
session_start();
require("./inc/connection.php");

// todo $query = "SELECT images FROM movies WHERE";
// todo $result = mysqli_query($db,$query);
?>

<!doctype html>
<html lang="en">

<head>
    <?php 
        include("./inc/header.php");
    ?> <!-Includes basic header->
        <link rel="stylesheet" href="./css/style.css">
        <title>Tecbooks</title>
</head>

<body>
    <nav>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <ul class="nav-links">
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col">
                <p>col 1</p>
            </div>
            <div class="col">
                <p>col 2</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php include("./inc/card.php");?>
            </div>
        </div>
    </div>

    <script src="./js/nav-mobile.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>