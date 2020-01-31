<?php
session_start();
if($_SESSION['login'] != "admin"){
    header("location: ../login.php");
}

include("../inc/connection.php");

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$repeatpassword = $_POST['repeatpassword'];

$query = "SELECT * FROM users WHERE username ='$username'";
$result = mysqli_query($db,$query);

if (mysqli_num_rows($result)>0) {
    echo "Username already exists";
}elseif ($password != $repeatpassword) {
    echo "Passwords do not match";
}else {
    
    $sql = "INSERT INTO users (username,pass,email,usertype) VALUES
    ('$username','$password','$email','admin')";

    if(!mysqli_query($db,$sql)) {
        die ('Error: ' .mysqli_error($db));
    }
}
header("location: ../index.php");