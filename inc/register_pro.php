<?php
session_start(); #Starts/loads session for this page
require("../inc/connection.php"); #Includes connection to database, $db is variable for connection.
require("../inc/password.php"); #Required for BCRYPT hashing algorithm to function on PHP 5.3.10

$email = $_POST['email'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
$repeatpassword = $_POST['repeatpassword'];

$query = "SELECT * FROM Customers WHERE email ='$email'";
$result = mysqli_query($db,$query);

if (mysqli_num_rows($result)>0) {
    header("location: ../register.php?uex=1");
}elseif (!password_verify($repeatpassword, $pass)) {
    header("location: ../register.php?pm=1");
}else {
    $sql = "INSERT INTO Customers (firstname, surname, hashed_pass, email, user_type) VALUES
    ('$fname','$lname','$pass','$email','0')";

    if(!mysqli_query($db,$sql)) {
        die ('Error: ' .mysqli_error($db));
    }
    $_SESSION['login'] = 'nonadmin';
    $_SESSION['user_name'] = $fname;
    header("location: ../index.php");
}
?>