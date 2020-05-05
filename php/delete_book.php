<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../index.php");
}
require("./connection.php");
$stock_id = $_POST['stock_id'];


//Check if they have any orders
$check_orders = "SELECT order_id FROM Customer_Orders_Books WHERE Customer_Orders_Books.stock_id = ".$stock_id."";
$orders_result  = mysqli_query($db,$check_orders);
if(mysqli_num_rows($orders_result) > 0 ){
    echo 'Can\'t delete a book that is on an order';
}else {
//Delete book
$delete_sql = "DELETE FROM Books WHERE stock_id = ".$stock_id."";
mysqli_query($db,$delete_sql);
mysqli_close($db);
echo 'Book Deleted';
}
?>