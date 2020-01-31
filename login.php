<?php
#redirects if already logged in
session_start();
if(isset($_SESSION['login'])){
    header("location: ./index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php 
        include("./inc/header.php");
    ?> <!-Includes basic header->
        <script src="https://kit.fontawesome.com/6c30bf13b8.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="./css/style.css">
        <link href="./css/signin.css" rel="stylesheet">
        <title>Tecbooks</title>
</head>

<body>
    <div class="content">
        <?php
            include("./inc/navbar.php");
        ?>

        <div class="bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <form class="form-signin" action="./inc/login_pro.php" method="post">
                        <img class="mb-4" src="./img/logo.svg" alt="" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="email" id="inputEmail" name="email" class="form-control"
                            placeholder="Email address" required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" name="password" class="form-control"
                            placeholder="Password" required>
                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("./inc/scripts.php");?>
</body>

</html>