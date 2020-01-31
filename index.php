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
        <script src="https://kit.fontawesome.com/6c30bf13b8.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="./css/style.css">
        <title>Tecbooks</title>
</head>

<body>
    <div class="content">
        <header>
            <div class="logo">
                <a href="index.php"><img src="./img/logo.svg"></a>
            </div>

            <nav>
                <div class="hamburger">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <ul class="nav-links">
                    <li><a class="navanchor active" href="#">Home</a></li>
                    <li><a class="navanchor" href="#">Link</a></li>
                    <li><a class="navanchor" href="#">Link</a></li>


                    <div class="dropdown">
                        <i class="fas fa-user-circle fa-2x drop"></i>
                        <div class="dropdown-content">
                            <a href="#">Sign in</a>
                            <a href="#">Register</a>
                        </div>
                    </div>

                </ul>
            </nav>

            <div class="search-container">
                <form action"./inc/search.php">
                    <input type="text" placeholder="Search..">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </header>

        <div class="bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>main landing</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1>col 1</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Nisl nunc mi ipsum faucibus. Fringilla urna porttitor rhoncus
                        dolor purus. Elit sed vulputate mi sit amet mauris. Gravida quis blandit turpis cursus in hac
                        habitasse platea dictumst. Arcu risus quis varius quam quisque id diam vel. Nisl condimentum id
                        venenatis a. Ac turpis egestas integer eget aliquet nibh. Massa enim nec dui nunc mattis.
                        Pharetra convallis posuere morbi leo urna molestie. Semper eget duis at tellus at urna
                        condimentum. Nisl nunc mi ipsum faucibus vitae aliquet. Sem et tortor consequat id porta nibh
                        venenatis cras. Aliquet porttitor lacus luctus accumsan tortor posuere. At urna condimentum
                        mattis pellentesque id nibh tortor id aliquet. Eget lorem dolor sed viverra ipsum nunc aliquet
                        bibendum. Id donec ultrices tincidunt arcu non sodales neque.

                        Lacus viverra vitae congue eu consequat. Feugiat scelerisque varius morbi enim. Quam quisque id
                        diam vel quam elementum pulvinar. Aliquam etiam erat velit scelerisque in dictum. Cras pulvinar
                        mattis nunc sed blandit libero. A diam sollicitudin tempor id eu nisl nunc mi. Porttitor lacus
                        luctus accumsan tortor. Pellentesque dignissim enim sit amet venenatis urna cursus eget.
                        Suspendisse interdum consectetur libero id faucibus nisl. Consectetur adipiscing elit duis
                        tristique sollicitudin nibh. Sed libero enim sed faucibus turpis in eu. In nibh mauris cursus
                        mattis molestie a iaculis. Aliquam id diam maecenas ultricies mi eget mauris pharetra. Proin
                        fermentum leo vel orci porta non pulvinar neque laoreet. Commodo odio aenean sed adipiscing diam
                        donec adipiscing. Accumsan tortor posuere ac ut consequat semper viverra. Sit amet tellus cras
                        adipiscing enim eu turpis egestas pretium. Volutpat lacus laoreet non curabitur. Posuere lorem
                        ipsum dolor sit. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed velit.</p>
                </div>
                <div class="col">
                    <h1>col 2</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Nisl nunc mi ipsum faucibus. Fringilla urna porttitor rhoncus
                        dolor purus. Elit sed vulputate mi sit amet mauris. Gravida quis blandit turpis cursus in hac
                        habitasse platea dictumst. Arcu risus quis varius quam quisque id diam vel. Nisl condimentum id
                        venenatis a. Ac turpis egestas integer eget aliquet nibh. Massa enim nec dui nunc mattis.
                        Pharetra convallis posuere morbi leo urna molestie. Semper eget duis at tellus at urna
                        condimentum. Nisl nunc mi ipsum faucibus vitae aliquet. Sem et tortor consequat id porta nibh
                        venenatis cras. Aliquet porttitor lacus luctus accumsan tortor posuere. At urna condimentum
                        mattis pellentesque id nibh tortor id aliquet. Eget lorem dolor sed viverra ipsum nunc aliquet
                        bibendum. Id donec ultrices tincidunt arcu non sodales neque.

                        Lacus viverra vitae congue eu consequat. Feugiat scelerisque varius morbi enim. Quam quisque id
                        diam vel quam elementum pulvinar. Aliquam etiam erat velit scelerisque in dictum. Cras pulvinar
                        mattis nunc sed blandit libero. A diam sollicitudin tempor id eu nisl nunc mi. Porttitor lacus
                        luctus accumsan tortor. Pellentesque dignissim enim sit amet venenatis urna cursus eget.
                        Suspendisse interdum consectetur libero id faucibus nisl. Consectetur adipiscing elit duis
                        tristique sollicitudin nibh. Sed libero enim sed faucibus turpis in eu. In nibh mauris cursus
                        mattis molestie a iaculis. Aliquam id diam maecenas ultricies mi eget mauris pharetra. Proin
                        fermentum leo vel orci porta non pulvinar neque laoreet. Commodo odio aenean sed adipiscing diam
                        donec adipiscing. Accumsan tortor posuere ac ut consequat semper viverra. Sit amet tellus cras
                        adipiscing enim eu turpis egestas pretium. Volutpat lacus laoreet non curabitur. Posuere lorem
                        ipsum dolor sit. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed velit.</p>
                </div>
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