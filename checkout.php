<!--
Developed by Aaron Donaldson.
For educational purposes.
contact at ec1823622@edinburghcollege.ac.uk

This is the checkout page
-->

<?php
session_start();
require("./php/connection.php"); #Connects to database, $db is the mysqli link

#Redirects you if your cart is not set, means you manually navigated to this page
if(!isset($_SESSION['cart'])){
    header("location: ./index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>


    <title>Tecbooks</title>


    <script>
    //This function is called when the payment is approved by paypal
    function paymentSuccess(txn_id, total) {
        //txn_id is paypals transaction id
        //total is the total paid
        var xhttp;
        if (window.XMLHttpRequest) {
            xhttp = new XMLHttpRequest();
        } else {
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //Displays a message that payment has been successfully processed
                document.getElementById("pp").innerHTML =
                    "<h2>Feel free to leave this page</h2><br><a href=\"./index.php\" class=\"btn btn-primary\">Home</a>";
                document.getElementById("checkout_box").innerHTML = this.responseText;
            }
        };
        //Performs a AJAX call to payment_success.php to process payment being accepted
        xhttp.open("GET", "./php/payment_success.php?txn_id=" + txn_id + "&total=" + total, true);
        xhttp.send();
    }
    </script>
</head>

<body>
    <!-- nav.php includes the navbar on the top of the page -->
    <?php include("./inc/nav.php");?>


    <div class="container-fluid divider"></div>

    <!-- This is the actually checkout box, including the paypal smart buttons -->
    <div class="container-fluid margin-top">


        <div class="row ml-3">
            <h2>Checkout</h2>
        </div>

        <!--this div displays an alert inside of it when the payment is successful -->
        <div id="checkout_box"></div>


        <div class="row">
            <div class="col-sm">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Price</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        #Displays the current cart details to the user, including the total price they are going to pay
                        #That total price is also what is passed to paypal.
                        $total = 0;
                        for($x = 0; $x <= sizeof($_SESSION['cart']) - 1; $x = $x + 2) {
                            $stock_id = $_SESSION['cart'][$x];
                            $sql = "SELECT * FROM Books WHERE stock_id = ".$stock_id."";
                            $result = mysqli_query($db, $sql);
                            $array = mysqli_fetch_array($result);
                            $total = $total + ($array['product_price']*$_SESSION['cart'][$x+1]);
                            echo '
                            <tr>
                                <td>'.$array['title'].'</td>
                                <td>'.$array['author'].'</td>
                                <td>£'.$array['product_price'].'</td>
                                <td>
                                    Quantity: '.$_SESSION['cart'][$x+1].'
                                </td>
                            </tr>
                            ';
                        };
                        echo '
                        <tr>
                            <td></td>
                            <td>Subtotal: </td>
                            <td>£'.$total.'</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Shipping: </td>
                            <td>Free!</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Total: </td>
                            <td id="total">£'. $total .'</td>
                        </tr>
                        
                        ';



                #Below is the paypal smart buttons, they link using the client ID on that first script line
                #They accept the $total that was calculated above as the amount the customer will pay
                #they return a details object that contains the transaction id and the amount paid, along with other details
                #onApprove is the function that is called when the payment is approved at paypal        
                echo'
                    </tbody>
                </table>
            </div>
            <div id="pp" class="col-sm center-flex vertical">
                <div id="paypal-button-container" class="w-75"></div>
                <script
                    src="https://www.paypal.com/sdk/js?client-id=AcyGNb8WQN4rcN8FigD3HQClEBw2aloCcgL8llfC_35S5gaO4DGTWKIe95Ay82jWNx89MfeSgaxjb-vm&currency=GBP"
                    data-sdk-integration-source="button-factory">
                </script>
                <script>
                paypal.Buttons({
                    style: {
                        size: \'responsive\',
                        shape: \'pill\',
                        color: \'gold\',
                        layout: \'vertical\',
                        label: \'paypal\',

                    },
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: { value: \''.$total.'\'}
                            }]
                            
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            var txn_id = details.id 
                            paymentSuccess(txn_id, '.$total.')
                        });
                    }
                }).render(\'#paypal-button-container\');
                </script>
            </div>
        </div>
    </div>
                ';?>
                        <?php include("./inc/generic_footer.php");?>
                        <script src="./js/ajax.js"></script>
</body>

</html>