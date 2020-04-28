<?php
#session_start();
#require("./connection.php");
#$user_id = $_POST['given_name'];
#$txn_id = $_POST['txn_id'];
#$total = $_POST['mc_gross'];
#$date = date("Y-m-d");
#$insert = "INSERT INTO Customers_Orders (customer_id, order_status, date_order_placed, order_total, txn_id) VALUES ($user_id, 0, '$date', $total, '$txn_id')";
#if(!mysqli_query($db,$insert)) {
#    die ('Error: ' .mysqli_error($db));
#}
header("HTTP/1.1 200 OK");
?>