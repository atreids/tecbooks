<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../login.php");
}
require("..inc/connection.php");
$delmovie = $_POST['delmovie'];

$sql = "SELECT * FROM movies WHERE title = '$delmovie'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$file = $row['images'];
unlink($file);
$delsql = "DELETE FROM movies WHERE title = '$delmovie'";
mysqli_query($db,$delsql);
header("location: ../admintools.php");

?>