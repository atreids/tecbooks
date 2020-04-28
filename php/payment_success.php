<?php
session_start(); //Starts session, required for access to customers_id
require("./connection.php"); //includes database connection
$user_id = $_SESSION['user_id'];
$txn_id = $_GET['txn_id']; //these two GET variables are passed in from the details object inside onApprove inside the paypal buttons
$total = $_GET['total'];
$date = date("Y-m-d"); //Date format created is YYYY-MM-DD
//SQL query for inserting the data into the database
$insert = "INSERT INTO Customers_Orders (customer_id, order_status, date_order_placed, order_total, txn_id) VALUES ($user_id, 0, '$date', $total, '$txn_id')";
if(!mysqli_query($db,$insert)) { //Attemps to insert the data, throws error if it fails
    die ('Error: ' .mysqli_error($db));
}else { 
    //If query is successfully inserted, this code gets what the newly created order_id is for that new order
    $get_order_id = "SELECT order_id FROM Customers_Orders WHERE txn_id = '".$txn_id."'";
    if(!mysqli_query($db,$get_order_id)) {
        die ('Error: ' .mysqli_error($db));
    }else {
        $result = mysqli_query($db,$get_order_id);
    }
    $array = mysqli_fetch_assoc($result);
    $order_id = $array['order_id'];
    //This code is used to update Customers_Orders_Books table for the new order
    for($x = 0; $x <= sizeof($_SESSION['cart']) - 1; $x = $x + 2) {
        $stock_id = $_SESSION['cart'][$x];
        $quantity = $_SESSION['cart'][$x + 1];
        
        $sql_price = "SELECT * FROM Books WHERE stock_id = ".$stock_id."";
        $result = mysqli_query($db, $sql_price);
        $array = mysqli_fetch_array($result);
        $price = $array['product_price'];
        
        $insert_customers_orders = "INSERT INTO Customer_Orders_Books (order_id,stock_id,quantity,price) VALUES (".$order_id.",".$stock_id.",".$quantity.",".$price.")";
        if(!mysqli_query($db,$insert_customers_orders)) {
            die ('Error: ' .mysqli_error($db));
        }
    }
}


unset($_SESSION['cart']); //Unsets the cart as the customer has now purchased these books
//This echo displays an alert to the user on checkout.php
echo 
"<div class=\"alert alert-success\" role=\"alert\">
Payment Successful! PayPal has emailed you a receipt. Your order ID is: ".$order_id."
</div>";

?>