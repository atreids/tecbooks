<?php
#Used to display a customer's orders for managerial reasons on admin.php

session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../index.php");
}


require("./connection.php");

#Gets customers id and then retreives their order details from database
$customer_id = $_POST['customer_id'];
$customers_orders = "SELECT order_id, date_order_placed, order_total FROM Customers_Orders JOIN Customers ON 
Customers_Orders.customer_id=Customers.customer_id WHERE Customers.customer_id = ".$customer_id." ORDER BY order_id DESC";
$orderid_result = mysqli_query($db, $customers_orders);


if(mysqli_num_rows($orderid_result) < 1){
    #If they haven't made any orders, echo response
    echo '
    <div class="alert alert-warning w-50 margin-top">This customer has no orders</div>
    ';
}else {
    #Else they have made orders, echo response displaying all the orders they've made in a nice card layout
    #Admins can then change the order status on the card for each order
while($orderid_array = mysqli_fetch_array($orderid_result)){
    echo '
    <div class="card margin-top">
    <div class="card-header">
        Order ID: '.$orderid_array['order_id'].'<br>
        Date: '.$orderid_array['date_order_placed'].'
    </div>
    <ul class="list-group list-group-flush">
    ';
    $sql_orderdata = "SELECT * FROM Books JOIN Customer_Orders_Books ON Books.stock_id = Customer_Orders_Books.stock_id
    JOIN Customers_Orders ON Customer_Orders_Books.order_id = Customers_Orders.order_id JOIN Customers ON 
    Customers_Orders.customer_id=Customers.customer_id WHERE Customers.customer_id = ".$customer_id." AND Customers_Orders.order_id = ".$orderid_array['order_id']."";
    $orderdata_result = mysqli_query($db, $sql_orderdata);
    while($data_array = mysqli_fetch_assoc($orderdata_result)){
        echo '<li class="list-group-item">
                <b>Title:</b> '.$data_array['title'].'<br>
                <b>Author:</b> '.$data_array['author'].'<br>
                <b>Quantity:</b> x'.$data_array['quantity'].'<br>
                <b>Price:</b> £'.$data_array['price'].'<br>
                </li>';
    }
    echo '
    </ul>
    <div class="card-footer">
        Total: £'.$orderid_array['order_total'].'
        <form class="form-inline">
            <label for="orderstatus" class="sr-only">Change Order Status</label>
            <select id="orderstatus" class="form-control" onChange="change_order_status('.$orderid_array['order_id'].',this.value)">
                <option value="0">Processing</option>
                <option value="1">Out for Delivery</option>
                <option value="2">Delivered</option>
            </select>
        </form>
        <div class="alert alert-success d-none" id="changed_status_alert">
            Status changed
        </div>
    </div>
    </div>
    ';
}
}
?>