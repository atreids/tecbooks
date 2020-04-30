<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ./index.php");
}
require("./connection.php");
$stock_id = $_POST['stock_id'];
$delete_sql = "DELETE FROM Books WHERE stock_id = ".$stock_id."";
mysqli_query($db,$delete_sql);
mysqli_close($db);
?>