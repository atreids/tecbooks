<?php
session_start();
require("../inc/connection.php");
if(!isset($_SESSION['login'])){
    header("location: ../index.php");
}

$new_email = $_POST['email'];
$user = $_SESSION['user'];
$sql = "UPDATE users SET email = '$new_email' WHERE username = '$user'";

if(!mysqli_query($db,$sql)) {
    die ('Error: ' .mysqli_error($db));
}
header("location: ../accountpage.php");
?>