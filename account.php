<?php
session_start();
require("./php/connection.php");
?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks</title>
    <script>
    function change_email() {
        var xhttp;
        var new_email = document.getElementById("change_email").value;
        if (window.XMLHttpRequest) {
            xhttp = new XMLHttpRequest();
        } else {
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("change_email_form").className = "margin-top d-none";
                document.getElementById("email_updated_alert").className = "alert alert-success w-25 margin-top";
            }
        };
        xhttp.open("GET", "./php/update_email.php?new_email=" + new_email, true);
        xhttp.send();
    }

    function display_change_email_form() {
        document.getElementById("email_updated_alert").className = "alert alert-success w-25 margin-top d-none";
        document.getElementById("change_email_form").className = "margin-top";
    }
    </script>
</head>

<body class="d-flex flex-column">
    <?php include("./inc/nav.php");?>
    <div class="container-fluid divider"></div>
    <div class="container margin-top">
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#details">Your
                    Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#addresses">Your Addresses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#history">Purchase History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reviews">Reviews</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="details">
                <?php
                    $sql = "SELECT * FROM Customers WHERE customer_id = ".$_SESSION['user_id']."";
                    if(!mysqli_query($db,$sql)) {
                        die ('Error: ' .mysqli_error($db));
                    }else{
                        $result = mysqli_query($db,$sql);
                        $array = mysqli_fetch_array($result);
                        $firstname = $array['firstname'];
                        $lastname = $array['surname'];
                        $email = $array['email'];
                    }
                ?>
                <h3 class="margin-top">Your Details:</h3>
                <p>Name: <?php echo $firstname." ".$lastname;?></p>
                <p>Email: <?php echo $email ?></p>
                <button class="btn btn-warning" onClick="display_change_email_form()">Change Email</button>
                <div id="change_email_form" class="margin-top d-none">
                    <div class="form-row">
                        <div class="form-group w-25">
                            <label for="change_email" class="sr-only">New Email:</label>
                            <input type="email" id="change_email" name="change_email" class="form-control"
                                placeholder="New Email" required>
                        </div>
                        <div class="form-group w-25 ml-1">
                            <button class="btn btn-primary" onClick="change_email()">Submit</button>
                        </div>
                    </div>
                </div>
                <div id="email_updated_alert" class="alert alert-success w-25 margin-top d-none" role="alert">
                    Email Updated!
                </div>
            </div>
            <div class="tab-pane fade" id="addresses">
                <?php
                    $sql = "SELECT * FROM Addresses JOIN Customer_Addresses ON Addresses.address_id = Customer_Addresses.address_id
                    JOIN Customers ON Customer_Addresses.customer_id = Customers.customer_id WHERE Customers.customer_id = ".$_SESSION['user_id']."";
                    if(!mysqli_query($db,$sql)) {
                        die ('Error: ' .mysqli_error($db));
                    }else{
                        $result = mysqli_query($db,$sql);
                        $address_array = mysqli_fetch_array($result);
                    }
                ?>
                <div class="card margin-top" style="width:20rem;">
                    <div class="card-header">
                        Your Address
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <?php echo $address_array['address1']; ?>
                        </li>
                        <?php if(isset($address_array['address2']) and !empty($address_array['address2'])) {
                            echo '
                            <li class="list-group-item">
                                '.$address_array['address2'].' 
                            </li>
                            ';
                            }; ?>
                        <li class="list-group-item">
                            <?php echo $address_array['zip_postcode']; ?>
                        </li>
                        <li class="list-group-item">
                            <?php echo $address_array['city']; ?>
                        </li>
                        <li class="list-group-item">
                            <?php echo $address_array['country']; ?>
                        </li>
                    </ul>
                    <div class="card-body">
                        <button class="btn btn-warning margin-top" onClick="display_change_address_form()">Change
                            Address</button>
                        <button class="btn btn-danger margin-top" onClick="display_change_address_form()">
                            Remove Address</button>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="history">
                <?php
                $customers_orders = "SELECT order_id, date_order_placed, order_total FROM Customers_Orders JOIN Customers ON 
                Customers_Orders.customer_id=Customers.customer_id WHERE Customers.customer_id = ".$_SESSION['user_id']." ORDER BY order_id DESC";
                $orderid_result = mysqli_query($db, $customers_orders);
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
                    Customers_Orders.customer_id=Customers.customer_id WHERE Customers.customer_id = ".$_SESSION['user_id']." AND Customers_Orders.order_id = ".$orderid_array['order_id']."";
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
                    </div>
                    </div>
                    ';
                }
                ?>

                <div class="card margin-top">
                    <div class=" card-header">
                        Have a problem with an order?
                    </div>
                    <div class="card-body">
                        We'd like to think that every order can go off without a hitch!<br>
                        However, we know that sometimes things happen in life that we don't plan for.<br>
                        So if you have any problems at all with your order, feel free to<br>
                        <a href="./contact.php" class="btn btn-primary margin-top">Contact Us!</a>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="reviews">...</div>
        </div>

        <div class="container margin-top-lg margin-bottom">
            <div class="row">
                <div class="col-sm center-flex flex-column">
                    <h2><em>“The more that you read, the more things you will know. The more that you learn, the more
                            places
                            you’ll go.”</em> – Dr. Seuss</h2>
                    <p>Want to get even more reading in? Next time you are in store, talk to us about signing up to our
                        monthly newsletter.
                        <br>You'll receive all sorts of news on upcoming deals!</p>
                </div>
                <div class="col-sm">
                    <img src="./img/bookshelves.jpg" class="circle vsm-img">
                </div>
            </div>
        </div>
    </div>
    <?php include("./inc/generic_footer.php");?>
</body>

</html>