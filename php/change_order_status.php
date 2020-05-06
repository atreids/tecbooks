<?php
#Used from the admin.php page
#Changes the order status of an order

session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../index.php");
}

require("./connection.php");

#Gets the order id to change and its new status
$order_id = $_POST['order_id'];
$status = $_POST['status'];

#Prepares sql statement and attempts to execute the query
$sql = "UPDATE Customers_Orders SET order_status = '$status' WHERE order_id = '$order_id'";
if(!mysqli_query($db,$sql)) {
    die ('Error: ' .mysqli_error($db));
}else {
    mysqli_close($db);
}

?>