<?php
#Changes a user's password
#Called from account.php
session_start();
require("./connection.php");
require("./password.php"); #Need for BCRYPT to work in PHP 5.3.10


#Redirects if not logged in
if(!isset($_SESSION['login'])){
    header("location: ../index.php");
}
#Receives users data through post
$customer_id = $_SESSION['user_id'];
$current_password = $_POST['currentpassword'];
$new_password = $_POST['new_password'];
$repeat_new_password = $_POST['repeat_new_password'];

#Gets existing password from database
$sql = "SELECT * FROM Customers WHERE customer_id = ".$customer_id."";
$result = mysqli_query($db,$sql);
$array = mysqli_fetch_assoc($result);


#Checks if the passwords matches, and that the current password can be verified
if(!$new_password == $repeat_new_password) {
    echo 'Passwords do not match.';
}elseif(!password_verify($current_password, $array['hashed_pass'])) {
    echo 'Incorrect current password.';
}else {
    #If all conditions are met, hashes the new password and then stores it
    $pass = password_hash($new_password, PASSWORD_BCRYPT);
    $update_sql = "UPDATE Customers SET hashed_pass = '".$pass."' WHERE customer_id = ".$customer_id."";
    mysqli_query($db, $update_sql);
    #Echo for the alert on account.php
    echo 'Password Updated';
}

?>