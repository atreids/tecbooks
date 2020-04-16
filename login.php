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
    <?php include("./inc/header.php");?>
    <link rel="stylesheet" href="./css/logincss.css">
    <!-- Includes universal header -->
    <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/navbar.php");?>
    <!-- Includes universal navbar -->


    <div class="divider">

    </div>
    <div class="container-fluid center-text">
        <form class="form-signin" action="./inc/login_pro.php" method="post">
            <h2 class="form-signin-heading">Please Login</h2>
            <label for="email" class="sr-only">Email Address</label>
            <input class="form-control" type="email" id="email" name="email" placeholder="Email" required autofocus>
            <label for="password" class="sr-only">Password</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
        <?php
    if(isset($_GET['loginfailed'])) {
        echo '<h4 style="color:red;margin-top:2px;">Login failed</h4>';
    } ?>
    </div>

    <?php include("./inc/footer.php");?>
    <!-- Includes universal footer -->
</body>

</html>