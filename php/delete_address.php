<?php
#Used to delete a user's address
#Called from account.php


session_start();
#Redirects if not logged in
if(!isset($_SESSION['login'])){
    header("location: ../index.php");
}

#Receives data from ajax POST
$customer_id = $_POST['customer_id'];
$address_id = $_POST['address_id'];

require("./connection.php");

#Removes address
$delete_address ="DELETE FROM Customer_Addresses WHERE Customer_Addresses.customer_id = ".$customer_id." AND Customer_Addresses.address_id = ".$address_id."";
if(!mysqli_query($db,$delete_address)) { 
    die ('Error: ' .mysqli_error($db));
};

?>