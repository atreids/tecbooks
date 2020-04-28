<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$txn_id = "47A64335NA5281146";
require("./php/connection.php");
$get_order_id = "SELECT order_id FROM Customers_Orders WHERE txn_id = '".$txn_id."'";
if(!mysqli_query($db,$get_order_id)) {
    die ('Error: ' .mysqli_error($db));
}else {
    $result = mysqli_query($db,$get_order_id);
}
$array = mysqli_fetch_assoc($result);
$order_id = $array['order_id'];
echo $order_id;
?>