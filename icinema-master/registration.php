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
    ?>
    <link rel="stylesheet" href="./css/registercss.css">
    <title>Registration</title>
  </head>
  <body>
    <?php
      include("./inc/navbar.php");
    ?>


    <!-- Register form -->
    <div class="bodylog">
        <form class="form-signin" action="./php/registrationpro.php" method="post">

            <img class="mb-4" src="./img/playbutton.png" alt="" width="72" height="72">

            <h1 class="h3 mb-3 font-weight-normal">Register</h1>

            <label for="inputuser" class="sr-only">Create Username</label>
            <input type="text" id="inputuser" name="username" class="form-control" placeholder="Create Username" required autofocus>

            <label for="inputuser" class="sr-only">Enter Email</label>
            <input type="email" id="inputuser" name="email" class="form-control" placeholder="Enter Email" required>

            <label for="inputPassword" class="sr-only">Create Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Create Password" required>

            <label for="inputPassword" class="sr-only">Repeat Password</label>
            <input type="password" id="inputPassword" name="repeatpassword" class="form-control" placeholder="Repeat Password" required>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

            <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>

            <?php
                if(isset($_GET['uex'])) {
                    echo '<h4 style="color:red;margin-top:2px;">Username already exists.</h4>';
                }

                if(isset($_GET['pm'])) {
                  echo '<h4 style="color:red;margin-top:2px;">Passwords do not match.</h4>';
              }
            ?>
        </form>
        
    </div>

    <?php
      include("./inc/footer.php");
    ?>
  </body>
</html>