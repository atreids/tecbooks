<?php
session_start();
#Redirects if not an admin
if(!isset($_SESSION['login'])){
    header("location: ./index.php");
}
require("./connection.php");
$review_id = $_POST['review_id'];
//Delete book
$delete_sql = "DELETE FROM Reviews WHERE review_id = ".$review_id."";
mysqli_query($db,$delete_sql);
mysqli_close($db);
?>