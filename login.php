<!--
Developed by Aaron Donaldson.
For educational purposes.
contact at ec1823622@edinburghcollege.ac.uk

This is the login page
-->

<?php
session_start();
require("./php/connection.php"); #Connects to the database, $db is the mysqli link
require("./php/password.php"); #Required for BCRYPT hashing algorithm to function on PHP 5.3.10

#If already logged in page redirects
if(isset($_SESSION['login'])){
    header("location: ./index.php");
}

#Code below is called when login form is submitted
if(isset($_POST['submit'])) {

    #User entered info
    $email = $_POST['inputEmail'];
    $pass = $_POST['inputPassword'];

    #Gets corrisponding user from database using the email
    $query1 = "SELECT * FROM Customers WHERE email = '$email'";
    $result = mysqli_query($db,$query1);
    $row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);

    #If both the email matches and the password is verified performs login process
    if ($email == $row1['email'] and password_verify($pass,$row1['hashed_pass'])) {

        #Ensures session is started, then declares session data to log in the customer
        session_start();
        $_SESSION['user_id'] = $row1['customer_id']; #customers id
        $_SESSION['user_name'] = $row1['firstname'];#Customers first name
        if ($row1['user_type'] == "1") { #if the customer has user_type 1 in the database that means they are an admin
            $_SESSION['login'] = "admin"; #declares as admin
            header("location: ./index.php");
        }else {
            $_SESSION['login'] = "nonadmin"; #else declares as non admin
            header("location: ./index.php");
        }
    }else {
        header("location: ./login.php?loginfailed=1"); #If email doesn't match or password doesn't verify, redirects back to login page with an error message
    };
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks | Login</title>
</head>

<body class="d-flex flex-column">

    <!-- includes navbar -->
    <?php include("./inc/nav.php");?>

    <!-- small dividing black line below navbar -->
    <div class="container-fluid divider"></div>

    <!--Actual login form container -->
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

        <!-- this php displays a small error message if the login fails -->
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

    <!--includes some needed <script></script> tags -->
    <?php include("./inc/generic_footer.php");?>
</body>

</html>