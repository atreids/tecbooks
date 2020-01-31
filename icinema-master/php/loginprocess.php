<?php
include("../inc/connection.php");

$user = $_POST['username'];
$pass = $_POST['password'];
$query = "SELECT * FROM users WHERE username = '$user' AND pass = '$pass'";
$result = mysqli_query($db,$query);

if (mysqli_num_rows($result) == 1) {
    session_start();
    $_SESSION['user'] = $user;
    $query2 = "SELECT usertype FROM users WHERE username = '$user'";
    $result2 = mysqli_query($db,$query2);
    $row = mysqli_fetch_array($result2,MYSQLI_ASSOC);
    if ($row['usertype'] == "admin") {
        $_SESSION['login'] = "admin";
        header("location: ../index.php");
    }else {
        $_SESSION['login'] = "member";
        header("location: ../index.php");
    }
}else {
    header("location: ../login.php?loginfailed=1");
};
?>