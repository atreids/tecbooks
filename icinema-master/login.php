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
    <!--basic header-->
    <?php
      require("./inc/header.php");
    ?>
    <!--css specific for login-->
    <link href="./css/logincss.css" rel="stylesheet">
    <title>Login</title>
  </head>
  <body>
    <!--navbar and js -->
    <?php
      require("./inc/navbar.php");
      include("./inc/footer.php");
    ?>

    <!-- login form -->
    <div class="bodylog">
        <form class="form-signin" action="./php/loginprocess.php" method="post">

            <img class="mb-4" src="./img/playbutton.png" alt="Logo Image" width="72" height="72">

            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <label for="inputuser" class="sr-only">Username</label>
            <input type="text" id="inputuser" name="username" class="form-control" placeholder="Username" required autofocus>

            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

            <?php
                if(isset($_GET['loginfailed'])) {
                    echo '<h4 style="color:red;margin-top:2px;">Login failed.</h4>';
                }
            ?>
            
        </form>
    </div>
    <!--registration-->
    <div class="bodylog">
      <form action="registration.php" method="post">
      <h1 class="h4 mb-3 font-weight-normal">Looking to join us?</h1>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
      </form>
    </div>

  </body>
</html>