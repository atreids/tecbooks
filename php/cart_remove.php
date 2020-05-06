<?php
#Used to remove a book from the cart
#
session_start();
#Gets the stock_id of the book to be removed
$stock_id = $_GET['stock_id'];

#finds the book in the array, unsets it and unsets +1 to remove the quantity
$key = array_search($stock_id, $_SESSION['cart']);
unset($_SESSION['cart'][$key]);
unset($_SESSION['cart'][$key+1]);

#Reorganises cart array so it doesn't have empty indexs in the middle
$_SESSION['cart'] = array_values($_SESSION['cart']);


#This echo returns into the body of the table in cart.php, to display the body again but without the book that was removed
echo'
    <?php
    if(!isset($_SESSION[\'cart\']) || empty($_SESSION[\'cart\'])) { {
    echo \'
        <tr>
            <td>#</td>
            <td><h3 class="bottom-h">Your cart is currently empty</h3></td>
            <td>#</td>
            <td>#</td>
        </tr>
    \';
    }else {
        $total = 0;
        for($x = 0; $x <= sizeof($_SESSION[\'cart\']) - 1; $x = $x + 2) {
            $stock_id = $_SESSION[\'cart\'][$x];
            $sql = "SELECT * FROM books WHERE stock_id = ".$stock_id."";
            $result = mysqli_query($db, $sql);
            $array = mysqli_fetch_array($result);
            $total = $total + ($array[\'product_price\']*$_SESSION[\'cart\'][$x+1]);
            echo \'
            <tr>
                <td>\'.$array[\'title\'].\'</td>
                <td>\'.$array[\'author\'].\'</td>
                <td>£\'.$array[\'product_price\'].\'</td>
                <td>
                    <form>
                        <label for="quantity">Quantity:</label>
                        <input onchange="change_quantity(\'.$stock_id.\')" style="width:3em;" id="quantity" name="quantity" type="number" value="\'.$_SESSION[\'cart\'][$x+1].\'" min="1" max="10">
                        <button class="btn" onClick="remove_item(\'.$stock_id.\')">
                            <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 016 6v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V6a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 01-1 1H13v9a2 2 0 01-2 2H5a2 2 0 01-2-2V4h-.5a1 1 0 01-1-1V2a1 1 0 011-1H6a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM4.118 4L4 4.059V13a1 1 0 001 1h6a1 1 0 001-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            \';
        };
        echo \'
        <tr>
            <td></td>
            <td>Subtotal:</td>
            <td id="total">£\'.$total.\'</td>
        </tr>
        
        \';
    }?>
';
?>