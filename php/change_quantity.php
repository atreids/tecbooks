<?php
#Used to update the quantity of a book in the cart
#Called from cart.php


session_start();
require("./connection.php");


//passed in from ajax javascript function
$stock_id = $_GET['stock_id']; 
$new_quantity = $_GET['quantity'];


//Get the key of the book in the cart array
$key = array_search($stock_id, $_SESSION['cart']);


//Change the quantity of that book, quantity is kept in $key+1 for all books in the cart
$_SESSION['cart'][$key+1] = $new_quantity;



//Calculate new total
$total = 0;
for($x = 0; $x <= sizeof($_SESSION['cart']) - 1; $x = $x + 2) {
    $stock_id2 = $_SESSION['cart'][$x];
    $sql = "SELECT * FROM Books WHERE stock_id = ".$stock_id2."";
    $result = mysqli_query($db, $sql);
    $array = mysqli_fetch_array($result);
    $total = $total + ($array['product_price']*$_SESSION['cart'][$x+1]);
}


//Return new total to be displayed on cart.php
echo '£'.$total;
?>