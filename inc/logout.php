<?php
session_start();
unset($_SESSION['login'],$_SESSION['user']);
header("location: ../index.php");
?>