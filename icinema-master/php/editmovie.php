<?php
session_start();
require("../inc/connection.php");
if(!isset($_SESSION['login'])){
    header("location: ../index.php");
}

$new_desc = $_POST['desc'];
$new_tickets = $_POST['tickets'];
$title = $_POST['upmovie'];
$sql = "UPDATE movies SET briefdesc = '$new_desc', tickets = '$new_tickets' WHERE title = '$title'";

if(!mysqli_query($db,$sql)) {
    die ('Error: ' .mysqli_error($db));
}
header("location: ../admintools.php");
?>