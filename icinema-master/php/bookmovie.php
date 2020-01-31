<?php
require("../inc/connection.php");
$movie = $_POST['movie'];
$tickets = $_POST['tickets'];

$sql = "SELECT tickets FROM movies WHERE title = '$movie'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);

$new_tickets = $row['tickets'] - $tickets;
if ($new_tickets >= 0){
    $sql = "UPDATE movies SET tickets = '$new_tickets' WHERE title = '$movie'";
    mysqli_query($db,$sql);
    header("location: ../confirmation.php?psucc=1&pmovie=$movie&ptickets=$tickets");
}else {
    header("location: ../booknow.php?failed=1");
}
?>