<?php
session_start();
$stock_id = $_GET['stocknumber']; #The stock number of the book being added was passed in through GET
if(!isset($_SESSION['cart'])) {
    $cart_array = array($stock_id); #If cart array does not already exist in $_SESSION, creates an array and adds it to $_SESSION
    $_SESSION['cart'] = $cart_array;
}else{
    $cart_len = sizeof($_SESSION['cart']); #Gets the current length of the cart
    $_SESSION['cart'][$cart_len] = $stock_id; #Amends new book to end of cart array
}
echo '<button class="btn btn-added">Added!</button>';
?>