<?php
#Used to delete a user's review
#Called from account.php through ajax on account.js by the customer

session_start();
#Redirects if not an admin
if(!isset($_SESSION['login'])){
    header("location: ../index.php");
}
require("./connection.php");
#gets id of review to delete
$review_id = $_POST['review_id'];
//Delete review
$delete_sql = "DELETE FROM Reviews WHERE review_id = ".$review_id."";
mysqli_query($db,$delete_sql);
mysqli_close($db);
?>