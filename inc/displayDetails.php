<?php 
session_start();
include("./connection.php");
$id = $_SESSION['user_id'];
$query = "SELECT firstname, surname, email FROM Customers WHERE customer_id = '$id'";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

echo "Name: " . $row['firstname'] . " " . $row['surname'] . "<br>";
echo "Email: " . $row['email'] . "<br>";
echo '<form action="javascript:updateEmail()" method="post">';
echo '<input id="newemail" class="input" type="email" placeholder="update email.." name="newemail"><br>';
echo '<input type="submit" class="btn" name="submit">';
echo '</form>';
echo '<div class="msg"></div>';

mysqli_close($db);

?>