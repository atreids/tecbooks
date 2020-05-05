<?php
#AJAX page, used for account.php email change
session_start();
require("./connection.php");
#Redirects if not logged in
if(!isset($_SESSION['login'])){
    header("location: ../index.php");
}
$user_id = $_SESSION['user_id'];
$new_email = $_GET['new_email'];
$sql = "UPDATE Customers SET email = '$new_email' WHERE customer_id = '$user_id'";
if(!mysqli_query($db,$sql)) {
    die ('Error: ' .mysqli_error($db));
}else {
    mysqli_close($db);
}
?>