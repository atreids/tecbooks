<?php
session_start();
include("./connection.php");

echo '<button id="payments" class="btn"
onclick="loadDoc(\'./inc/updatePayments.php\', paymentDetails)">Add New Payment</button>';

?>