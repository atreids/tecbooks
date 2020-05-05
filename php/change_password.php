<?php
session_start();
require("./connection.php");
require("./password.php");
#Redirects if not logged in
if(!isset($_SESSION['login'])){
    header("location: ../index.php");
}

$customer_id = $_SESSION['user_id'];
$current_password = $_POST['currentpassword'];
$new_password = $_POST['new_password'];
$repeat_new_password = $_POST['repeat_new_password'];


$sql = "SELECT * FROM Customers WHERE customer_id = ".$customer_id."";
$result = mysqli_query($db,$sql);
$array = mysqli_fetch_assoc($result);

if(!$new_password == $repeat_new_password) {
    echo 'Passwords do not match.';
}elseif(!password_verify($current_password, $array['hashed_pass'])) {
    echo 'Incorrect current password.';
}else {
    $pass = password_hash($new_password, PASSWORD_BCRYPT);
    $update_sql = "UPDATE Customers SET hashed_pass = '".$pass."' WHERE customer_id = ".$customer_id."";
    mysqli_query($db, $update_sql);
    echo 'Password Updated';
}

?>