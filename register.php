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
        <div class="row">
            <form class="form-singin" action="./inc/register_pro.php" method="post">
                <h2 class="form-signin-heading">Please Register</h2>
                <label for="email" class="sr-only">Email Address</label>
                <input class="form-control" type="email" name="email" placeholder="Email" required autofocus>
                <label for="firstname" class="sr-only">First Name</label>
                <input class="form-control" type="text" name="firstname" placeholder="First Name" required>
                <label for="lastname" class="sr-only">Last Name</label>
                <input class="form-control" type="text" name="lastname" placeholder="Last Name" required>
                <label for="password" class="sr-only">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <label for="repeatpassword" class="sr-only">Repeat Password</label>
                <input class="form-control" type="password" name="repeatpassword" placeholder="Repeat Password"
                    required>
                <button class="btn btn-lg btn-blue btn-block" type="submit">Register</button>
            </form>
            <?php
    if(isset($_GET['uex'])) {
        echo '<h4 style="color:red;margin-top:2px;">Email Already Registered.</h4>';
    }

    if(isset($_GET['pm'])) {
      echo '<h4 style="color:red;margin-top:2px;">Passwords do not match.</h4>';
  }
?>
        </div>
    </div>
    <?php include("./inc/footer.php");?>
    <!-- Includes universal footer -->
</body>

</html>