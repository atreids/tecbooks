<?php
session_start();
require("./php/connection.php");
if(!isset($_SESSION['cart'])){
    header("location: ./index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/nav.php");?>

    <div class="container buffer-top">
        <div class="row center-flex">
            <h2>Checkout</h2>
            <?php echo$_SESSION['test'];
                    echo'hello'; ?>
        </div>
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
                        $ttotal = 0.00;
                        $ttotal = $total + 3;
                        echo '
                        <tr>
                            <td></td>
                            <td>Subtotal: </td>
                            <td>£'.$total.'</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Processing: </td>
                            <td>£3.00</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Total: </td>
                            <td id="total">£'. $ttotal .'</td>
                        </tr>
                        
                        ';
                echo'
                    </tbody>
                </table>
            </div>
            <div class="col-sm center-flex">
                <div id="paypal-button-container"></div>
                <script
                    src="https://www.paypal.com/sdk/js?client-id=AcyGNb8WQN4rcN8FigD3HQClEBw2aloCcgL8llfC_35S5gaO4DGTWKIe95Ay82jWNx89MfeSgaxjb-vm&currency=GBP"
                    data-sdk-integration-source="button-factory">
                </script>
                <script>
                paypal.Buttons({
                    style: {
                        shape: \'rect\',
                        color: \'gold\',
                        layout: \'vertical\',
                        label: \'paypal\',

                    },
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: \''.$ttotal.'\'
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            alert(\'Payment Successful\');
                        });
                    }
                }).render(\'#paypal-button-container\');
                </script>
            </div>
        </div>
    </div>
                ';?>
                        <?php include("./inc/generic_footer.php");?>
</body>

</html>