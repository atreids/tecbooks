<?php
session_start();
require("./connection.php");
$user_id = $_SESSION['user_id'];
$txn_id = $_GET['txn_id'];
$total = $_GET['total'];
$date = date("Y-m-d");
$insert = "INSERT INTO Customers_Orders (customer_id, order_status, date_order_placed, order_total, txn_id) VALUES ($user_id, 0, '$date', $total, '$txn_id')";
if(!mysqli_query($db,$insert)) {
    die ('Error: ' .mysqli_error($db));
}else {
    $get_order_id = "SELECT order_id FROM Customers_Orders WHERE txn_id = '".$txn_id."'";
    if(!mysqli_query($db,$get_order_id)) {
        die ('Error: ' .mysqli_error($db));
    }else {
        $result = mysqli_query($db,$get_order_id);
    }
    $array = mysqli_fetch_assoc($result);
    $order_id = $array['order_id'];
}
unset($_SESSION['cart']);
echo 
"<div class=\"alert alert-success\" role=\"alert\">
Payment Successful! PayPal has emailed you a receipt. Your order ID is: ".$order_id."
</div>";
?>