<?php
session_start();
require("./php/connection.php");
require("./php/password.php"); #Required for BCRYPT hashing algorithm to function on PHP 5.3.10
if(isset($_SESSION['login'])){
    header("location: ./index.php");
}

if(isset($_POST['submit'])) {
    $email = $_POST['inputEmail'];
    $pass = $_POST['inputPassword'];
    $query1 = "SELECT * FROM customers WHERE email = '$email'";
    $result = mysqli_query($db,$query1);
    $row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if ($email == $row1['email'] and password_verify($pass,$row1['hashed_pass'])) {
        session_start();
        $_SESSION['user_id'] = $row1['customer_id'];
        $_SESSION['user_name'] = $row1['firstname'];
        if ($row1['user_type'] == "1") {
            $_SESSION['login'] = "admin";
            header("location: ./index.php");
        }else {
            $_SESSION['login'] = "nonadmin";
            header("location: ./index.php");
        }
    }else {
        header("location: ./login.php?loginfailed=1");
    };
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/nav.php");?>

    <div class="container">
        <form class="form-signin" action="" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address"
                required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password"
                required>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
        </form>
        <?php
    if(isset($_GET['loginfailed'])) {
        echo '<h4 style="color:red;margin-top:2px;">Login failed</h4>';
    } ?>
    </div>

    <?php include("./inc/generic_footer.php");?>
</body>

</html>