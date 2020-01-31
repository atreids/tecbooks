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
                    <form class="form-signin" action="./inc/register_pro.php" method="post">

                        <img class="mb-4" src="./img/logo.svg" alt="" width="72" height="72">

                        <h1 class="h3 mb-3 font-weight-normal">Register</h1>

                        <label for="inputuser" class="sr-only">Enter Email</label>
                        <input type="email" id="inputuser" name="email" class="form-control" placeholder="Enter Email"
                            required autofocus>

                        <label for="inputuser" class="sr-only">First Name</label>
                        <input type="text" id="inputuser" name="firstname" class="form-control" placeholder="Name"
                            required>

                        <label for="inputuser" class="sr-only">Surname</label>
                        <input type="text" id="inputuser" name="lastname" class="form-control" placeholder="Surname"
                            required>

                        <label for="inputPassword" class="sr-only">Create Password</label>
                        <input type="password" id="inputPassword" name="password" class="form-control"
                            placeholder="Create Password" required>

                        <label for="inputPassword" class="sr-only">Repeat Password</label>
                        <input type="password" id="inputPassword" name="repeatpassword" class="form-control"
                            placeholder="Repeat Password" required>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

                        <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>

                        <?php
    if(isset($_GET['uex'])) {
        echo '<h4 style="color:red;margin-top:2px;">Email Already Registered.</h4>';
    }

    if(isset($_GET['pm'])) {
      echo '<h4 style="color:red;margin-top:2px;">Passwords do not match.</h4>';
  }
?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("./inc/scripts.php");?>
</body>

</html>