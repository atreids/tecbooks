<?php
#Attempts to delete a customer
#called from account.php

session_start();
#Redirects if logged in
if(!isset($_SESSION['login'])){
    header("location: ../index.php");
}
require("./connection.php");
require("./password.php"); #Required to check if they entered the correct current password

#Receives customer_id of the customer and their confirmation password
$customer_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'];
#SQL used to check if passwords match
$customer_sql = "SELECT hashed_pass FROM Customers WHERE customer_id = '".$customer_id."'";
$cust_result = mysqli_query($db, $customer_sql);
$customer_array = mysqli_fetch_assoc($cust_result);

//Check if they have any orders
$check_orders = "SELECT order_id FROM Customers_Orders WHERE Customers_Orders.customer_id = ".$customer_id."";
$orders_result  = mysqli_query($db,$check_orders);
if(mysqli_num_rows($orders_result) > 0 ){
    #Checks they don't have orders ^
    #echo for alert
    echo 'Can\'t delete an account that has orders on it';
}elseif(!password_verify($current_password, $customer_array['hashed_pass'])){ 
    //Checks passwords match ^
    
    #echo for alert
    echo 'Incorrect password';
}else { //Deletes account

    
//Delete linking address data
$delete_address ="DELETE FROM Customer_Addresses WHERE Customer_Addresses.customer_id = ".$customer_id."";
if(!mysqli_query($db,$delete_address)) { 
    die ('Error: ' .mysqli_error($db));
};

#delete customer
$delete_sql = "DELETE FROM Customers WHERE customer_id = ".$customer_id."";
if(!mysqli_query($db,$delete_sql)) { 
    die ('Error: ' .mysqli_error($db));
};

mysqli_close($db);
#confirmation message
echo 'Account Deleted';
}
?>