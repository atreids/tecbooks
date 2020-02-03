<?php
include("../inc/connection.php");

$email = $_POST['email'];
$pass = $_POST['password'];
$query1 = "SELECT * FROM customers WHERE email = '$email'";
$result = mysqli_query($db,$query1);
$row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);

if ($email == $row1['email'] and password_verify($pass,$row1['hashed_pass'])) {
    session_start();
    $_SESSION['user_id'] = $row1['customer_id'];
    $_SESSION['user_name'] = $row1['firstname'];
    if ($checkadmin['usertype'] == "1") {
        $_SESSION['login'] = "admin";
        header("location: ../index.php");
    }else {
        $_SESSION['login'] = "nonadmin";
        header("location: ../index.php");
    }
}else {
    header("location: ../login.php?loginfailed=1");
};
?>