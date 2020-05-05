<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../index.php");
}
require("./connection.php");
$order_id = $_POST['order_id'];
$status = $_POST['status'];

$sql = "UPDATE Customers_Orders SET order_status = '$status' WHERE order_id = '$order_id'";
if(!mysqli_query($db,$sql)) {
    die ('Error: ' .mysqli_error($db));
}else {
    mysqli_close($db);
}

?>