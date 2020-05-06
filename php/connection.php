<?php
#This page is used to setup the mysqli database link if needed for other pages
$serveraddress = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "tecbooks";
$db = mysqli_connect($serveraddress, $username, $dbpassword, $dbname)
Or die ("ERROR: Failed to connect to database");
$db -> set_charset('utf8');

#$serveraddress = "localhost";
#$username = "HNDCSSA6";
#$dbpassword = "HpDPLzWDuw";
#$dbname = "HNDCSSA6";
//todo
#$db = mysqli_connect($serveraddress, $username, $dbpassword, $dbname)
#Or die ("failed to connect to databse");
?>