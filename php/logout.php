<?php
#Logs the user out
#Unsets all session data and redirects them to the home page

if(!isset($_SESSION['login'])) {
    header("location: ../index.php");
}

session_start();
unset($_SESSION['login'],$_SESSION['user_name']);
session_destroy();
header("location: ../index.php");
?>