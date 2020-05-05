<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../index.php");
}
require("./connection.php");
$customer_id = $_POST['customer_id'];
//Check if they have any orders
$check_orders = "SELECT order_id FROM Customers_Orders WHERE Customers_Orders.customer_id = ".$customer_id."";
$orders_result  = mysqli_query($db,$check_orders);
if(mysqli_num_rows($orders_result) > 0 ){
    echo 'Can\'t delete an account that has orders on it';
}else {
//Delete linking address data
$delete_address ="DELETE FROM Customer_Addresses WHERE Customer_Addresses.customer_id = ".$customer_id."";
if(!mysqli_query($db,$delete_address)) { 
    die ('Error: ' .mysqli_error($db));
};
$delete_sql = "DELETE FROM Customers WHERE customer_id = ".$customer_id."";
if(!mysqli_query($db,$delete_sql)) { 
    die ('Error: ' .mysqli_error($db));
};
mysqli_close($db);
echo 'Account Deleted';
}
?>