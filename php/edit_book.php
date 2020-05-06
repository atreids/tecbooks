<?php
#Called from admin.php to edit a books details
#Can edit all details except for isbn and stock_id

session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../index.php");
}


require("./connection.php");

#Gets the new details from the form (actually passed through ajax)
$stock_id = $_POST['stock_id'];
$new_title = $_POST['new_title'];
$new_author = $_POST['new_author'];
$new_price = $_POST['new_price'];
$new_quantity = $_POST['new_quantity'];
$new_desc = $_POST['new_desc'];
$new_cover = $_POST['new_cover'];

#Insertion sql
$insertion_sql =
"UPDATE Books SET 
title = \"".$new_title."\",
author = \"".$new_author."\",
book_desc = \"".$new_desc."\",
cover = \"".$new_cover."\",
quantity_stock = ".$new_quantity.",
product_price = ".$new_price."
WHERE stock_id = ".$stock_id."
;";

#Perform query
if(!mysqli_query($db,$insertion_sql)) {
    die ('Error: ' .mysqli_error($db));
}else {
    mysqli_close($db);
}
?>