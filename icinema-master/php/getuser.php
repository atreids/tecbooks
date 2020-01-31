<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../login.php");
}

$q = $_GET['q'];
require("../inc/connection.php");
$sql2 = "SELECT * FROM users WHERE username = '".$q."'";
$result = mysqli_query($db,$sql2);

echo "<table>
<tr>
<th>Username</th>
<th>Email</th>
<th>Usertype</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['usertype'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($db);
?>
</body>
</html>