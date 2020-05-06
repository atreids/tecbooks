<!--
Developed by Aaron Donaldson.
For educational purposes.
contact at ec1823622@edinburghcollege.ac.uk
-->

<?php
session_start();
include("./php/connection.php"); #Includes connection to database, $db is the mysqli link

#Redirects if not logged in
if(!isset($_SESSION['login'])){
    header("location: ./index.php");
}

#Unsets the cart if the empty cart button is pressed
if(isset($_POST['empty_cart'])) {
    unset($_SESSION['cart']);
}
?>

<!doctype html>
<html lang="en">

<head>

    <!-- includes necessary meta tags and other data -->
    <?php require("./inc/generic_header.php");?>

    <script>
    function remove_item(stock_id) {
        //Function is called when the trash button is clicked for an item in the cart
        var xhttp;
        if (window.XMLHttpRequest) {
            xhttp = new XMLHttpRequest();
        } else {
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //Updates cart table with new cart data, including price
                document.getElementById("table_body").innerHTML = this.responseText;
            }
        };
        //performs ajax request to remove the specified book from the cart session data 
        xhttp.open("GET", "./php/cart_remove.php?stock_id=" + stock_id, true);
        xhttp.send();
    }

    function change_quantity(stock_id, quantity) {
        //Is called when the quantity of a book is changed
        var xhttp;
        if (window.XMLHttpRequest) {
            xhttp = new XMLHttpRequest();
        } else {
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //Updates cart table with new cart data, including price
                document.getElementById("total").innerHTML = this.responseText;
            }
        };
        //performs ajax request to change the quantity of specified book in cart session data
        xhttp.open("GET", "./php/change_quantity.php?stock_id=" + stock_id + "&quantity=" + quantity, true);
        xhttp.send();
    }
    </script>
</head>

<body>

    <!-- Includes the navbar -->
    <?php include("./inc/nav.php"); ?>


    <div class="container-fluid divider"></div>

    <!--container containing all cart display -->
    <div class="container-fluid margin-top margin-bottom">

        <!-- Cart title -->
        <div class="row ml-3">
            <h2>Your Cart</h2>
        </div>

        <!-- contains table displaying current cart contents, and the move to checkout buttons -->
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
                    <tbody id="table_body">

                        <?php
                        #Checks if cart is empty, if so displays a small message saying so, if not displays cart in a table
                    if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                    echo '
                        <tr>
                            <td>#</td>
                            <td><h3 class="bottom-h">Your cart is currently empty</h3></td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                    ';
                    }else {
                        $total = 0;
                        #This loop increases by +2 because every second element in the cart array is actually the quantity of the book immediately before it
                        #So [0] would be the stock_id of the first book in the cart, and [1] would be the quantity of that book
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
                                    <form>
                                        <label for="quantity">Quantity:</label>
                                        <select onchange="change_quantity('.$stock_id.',this.value)" style="width:3em;" id="quantity" name="quantity">
                                            <option selected="selected">'.$_SESSION['cart'][$x+1].'</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        <button class="btn" onClick="remove_item('.$stock_id.')">
                                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            ';
                        };
                        echo '
                        <tr>
                            <td></td>
                            <td>Subtotal:</td>
                            <td id="total">£'.$total.'</td>
                        </tr>
                        
                        ';
                    }
                ?>
                    </tbody>
                </table>
            </div>

            <!--the move to checkout buttons and empty cart button -->
            <div class="col-sm d-flex flex-column">
                <?php 

                    if(isset($_SESSION['cart']) and !empty($_SESSION['cart'])) {
                        echo '<a href="checkout.php" class="btn btn-primary margin-bottom">Checkout</a>';
                    }else {
                        echo '<a href="#" class="btn btn-secondary disabled margin-bottom">Checkout</a>';
                    };
                ?>
                <form action="#" method="post">
                    <button class="btn btn-warning" name="empty_cart" style="width:100%;">Empty Cart</button>
                </form>
            </div>
        </div>


    </div>


    <!-- Includes universal footer -->
    <?php include("./inc/generic_footer.php");?>


    <script src="./js/ajax.js"></script>

</body>

</html>