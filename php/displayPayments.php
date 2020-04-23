<?php
session_start();
include("./connection.php");

echo '<button id="payments" class="btn btn-blue"
onclick="loadDoc(\'./inc/updatePayments.php\', paymentDetails)">Add New Payment</button>';

?>