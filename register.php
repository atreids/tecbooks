<?php
session_start();
require("./php/connection.php");
require("./php/password.php"); #Required for BCRYPT hashing algorithm to function on PHP 5.3.10
if(isset($_SESSION['login'])){
    header("location: ./index.php");
}

if(isset($_POST['submit'])) {
    $email = $_POST['inputEmail'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $repeatpassword = $_POST['repeatpassword'];
    
    $query = "SELECT * FROM Customers WHERE email ='$email'";
    $result = mysqli_query($db,$query);
    if (mysqli_num_rows($result)>0) {
        header("location: ./register.php?uex=1");
    }elseif (!password_verify($repeatpassword, $pass)) {
        header("location: ./register.php?pm=1");
    }else {
        $sql = "INSERT INTO Customers (firstname, surname, hashed_pass, email, user_type) VALUES
        ('$fname','$lname','$pass','$email','0')";
    
        if(!mysqli_query($db,$sql)) {
            die ('Error: ' .mysqli_error($db));
        }
        $_SESSION['login'] = 'nonadmin';
        $_SESSION['user_name'] = $fname;
        header("location: ./index.php");
    }
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
    <div class="container-fluid divider"></div>

    <div class="container center-flex">
        <form class="form-signin" action="" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Register</h1>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address"
                required autofocus>

            <label for="firstname" class="sr-only">First Name</label>
            <input class="form-control" id="firstname" type="text" name="firstname" placeholder="First Name" required>

            <label for="lastname" class="sr-only">Last Name</label>
            <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Last Name" required>

            <label for="password" class="sr-only">Password</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>

            <label for="repeatpassword" class="sr-only">Repeat Password</label>
            <input class="form-control" type="password" id="repeatpassword" name="repeatpassword"
                placeholder="Repeat Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button>
            <p class="mt-5 mb-3 text-muted">Tecbooks &copy; 2019-2020</p>
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

    <?php include("./inc/generic_footer.php");?>
</body>

</html>