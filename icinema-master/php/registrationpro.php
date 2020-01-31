<?php
session_start();
include("../inc/connection.php");

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$repeatpassword = $_POST['repeatpassword'];

$query = "SELECT * FROM users WHERE username ='$username'";
$result = mysqli_query($db,$query);

if (mysqli_num_rows($result)>0) {
    header("location: ../registration.php?uex=1");
}elseif ($password != $repeatpassword) {
    header("location: ../registration.php?pm=1");
}else {
    $sql = "INSERT INTO users (username,pass,email,usertype) VALUES
    ('$username','$password','$email','member')";

    if(!mysqli_query($db,$sql)) {
        die ('Error: ' .mysqli_error($db));
    }
    $_SESSION['login'] = 'member';
    $_SESSION['user'] = $username;
    header("location: ../index.php");
}
?>