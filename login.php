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
    $query1 = "SELECT * FROM Customers WHERE email = '$email'";
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

<body class="d-flex flex-column">
    <?php include("./inc/nav.php");?>
    <div class="container-fluid divider"></div>

    <div class="container margin-top-lg w-50">
        <form action="" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
            <div class="form-group">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="john@email.com"
                    required autofocus>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">Tecbooks &copy; 2019-2020</p>
        </form>
        <?php
            if(isset($_GET['loginfailed'])) {
                echo '
                    <div class="alert alert-danger" role="alert">
                        Login failed.
                    </div>
                    ';
            } 
        ?>
    </div>
    <?php include("./inc/generic_footer.php");?>
</body>

</html>