<?php
    session_start();
    require("./php/connection.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $sql = "SELECT * FROM Books JOIN Customer_Orders_Books ON Books.stock_id = Customer_Orders_Books.stock_id
    JOIN Customers_Orders ON Customer_Orders_Books.order_id = Customers_Orders.order_id JOIN Customers ON 
    Customers_Orders.customer_id=Customers.customer_id WHERE Customers.customer_id = 10000 AND Customers_Orders.order_id = 100000";
    if(!mysqli_query($db,$sql)) {
        die ('Error: ' .mysqli_error($db));
    }else{
        echo ("Inside else statement");
        $result = mysqli_query($db,$sql);
        $array = mysqli_fetch_array($result);
    }
?>

<!doctype html>
<html>

<body>
    <table>
        <tr>
            <td>Order ID</td>
            <td>Customer</td>
            <td>Book</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>txn_id</td>
        </tr>
        <?php
        while($array = mysqli_fetch_array($result)) {
            echo '
            <tr>
            <td>'.$array['order_id'].'</td>
            <td>'.$array['firstname'].' '.$array['surname'].'</td>
            <td>'.$array['title'].'</td>
            <td>'.$array['price'].'</td>
            <td>'.$array['quantity'].'</td>
            <td>'.$array['txn_id'].'</td>
            </tr>
            ';
        };
        ?>

    </table>
</body>

</html>