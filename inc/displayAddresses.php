<?php
session_start();
include("./connection.php");





echo '<button id="addresses" class="btn" onclick="loadDoc(\'./inc/updateAddress.php\', addressDetails)">
Add New Address</button>';
?>