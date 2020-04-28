<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("./php/connection.php");
$email = "testuser@email.com";
echo $email;
$sql_id = "SELECT * FROM Customers WHERE email LIKE '".$email."'";
$result = mysqli_query($db, $sql_id);
if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
$array = mysqli_fetch_array($result);
$user_id = $array['customer_id'];
echo $user_id;
?>