<!DOCTYPE html>
<html>

<head>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    td,
    th {
        border: 1px solid white;
        padding: 5px;
    }

    th {
        text-align: left;
    }
    </style>
</head>

<body>
    <?php 
session_start();
include("./connection.php");
$user_id = $_SESSION['user_id'];
$query = "SELECT firstname, surname, email FROM Customers WHERE customer_id = '$user_id'";
$result = mysqli_query($db,$query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

echo "<table>
<tr>
<th>Name</th>
<th>Email</th>
</tr>";
echo "<tr><td>" .$row['firstname'] . " " . $row['surname'] . "</td>
        <td>" . $row['email'] . "</td>
</tr></table>";

mysqli_close($db);

?>
</body>

</html>