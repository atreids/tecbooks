<?php  
session_start();
require("../inc/connection.php");
if($_SESSION['login'] != "admin"){
    header("location: ../login.php");
}

$title = $_POST['title'];
$briefdesc = $_POST['briefdesc'];
$longdesc = $_POST['longdesc'];
$tickets = $_POST['tickets'];
$target_dir = "../img/";
$tmpimg = $_POST['image'];
$image = $target_dir.$tmpimg;


$sql = "INSERT INTO movies (title,images,briefdesc,longdescription,tickets) VALUES
('$title','$image','$briefdesc','$longdesc','$tickets')";
if(!mysqli_query($db,$sql)) {
    die ('Error: ' .mysqli_error($db));
}
header("location: ../admintools.php");

?>