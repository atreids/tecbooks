<?php
session_start();
require("./connection.php");
$stock_id = $_GET['stock_id'];
$new_quantity = $_GET['quantity'];
$key = array_search($stock_id, $_SESSION['cart']);
$_SESSION['cart'][$key+1] = $new_quantity;
$total = 0;
$sql = "SELECT * FROM Books WHERE stock_id = ".$stock_id."";
$result = mysqli_query($db, $sql);
$array = mysqli_fetch_array($result);
$total = $total + ($array['product_price']*$new_quantity);
echo '£'.$total;
?>