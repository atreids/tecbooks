<?php
#Cart functions by storing the stock_id of the book in the cart, the index directly +1 of the stock_id is the quantity of that book to order.
session_start();
$stock_id = $_GET['stocknumber']; #The stock number of the book being added was passed in through GET
if(!isset($_SESSION['cart'])) {
    $cart_array = array($stock_id, 1); #If cart array does not already exist in $_SESSION, creates an array and adds it to $_SESSION
    $_SESSION['cart'] = $cart_array;
}elseif(in_array($stock_id, $_SESSION['cart'])){
    $key = array_search($stock_id, $_SESSION['cart']); #Finds index of the current book already in the cart
    $_SESSION['cart'][$key+1] = $_SESSION['cart'][$key+1] +1; #Adds 1 to quantity ordered
}else {
    $cart_len = sizeof($_SESSION['cart']); #Gets the current length of the cart
    $_SESSION['cart'][$cart_len] = $stock_id; #Amends new book to end of cart array
    $_SESSION['cart'][$cart_len+1] = 1; #Amends new book to end of cart array
}
echo '<button class="btn btn-added">Added!</button>'; #changes the displayed button to show it has been added
?>