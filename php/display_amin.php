<?php
#The naming of this file is not a misspelling, having display_admin will cause the call to be 
#blocked by most ad blockers because of the display_ad part
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ./index.php");
}
require("./connection.php");
$customer_id = $_POST['customer_id'];
$retrieve_admin = "SELECT * FROM Customers WHERE customer_id = ".$customer_id."";
$result = mysqli_query($db,$retrieve_admin);
$array = mysqli_fetch_assoc($result);

echo '
<tr>
    <td>'.$array['customer_id'].'</td>
    <td>'.$array['firstname'].' '.$array['surname'].'</td>
    <td><button class="btn btn-danger" onClick="delete_admin('.$array['customer_id'].')">Delete</button></td>
</tr>
';

?>