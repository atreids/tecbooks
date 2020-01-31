<?php
include("../inc/connection.php");

$email = $_POST['email'];
$pass = $_POST['password'];
$hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
$query = "SELECT * FROM Customers WHERE email = '$email' AND hashed_pass = '$hashed_pass'";
$result = mysqli_query($db,$query);

if (mysqli_num_rows($result) == 1) {
    session_start();
    $query3 = "SELECT firstname FROM Customers WHERE email = '$email'";
    $_SESSION['user'] = mysqli_query($db,$query3);
    $query2 = "SELECT user_type FROM Customers WHERE email = '$email'";
    $result2 = mysqli_query($db,$query2);
    $row = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    if ($row['usertype'] == "1") {
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