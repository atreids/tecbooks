<?php
if(!isset($_SESSION['login'])) {
    header("../index.php");
}

session_start();
unset($_SESSION['login'],$_SESSION['user_name']);
session_destroy();
header("location: ../index.php");
?>