<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../login.php");
}
require("../inc/connection.php");
$deluser = $_POST['deluser'];
$delsql = "DELETE FROM users WHERE username = '$deluser'";
mysqli_query($db,$delsql);
header("location: ../admintools.php");
?>