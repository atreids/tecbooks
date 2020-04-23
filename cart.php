<?php
session_start();
include("./php/connection.php");

if(!isset($_SESSION['login'])){
    header("location: ./index.php");
}

if(isset($_POST['empty_cart'])) {
    unset($_SESSION['cart']);
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php require("./inc/generic_header.php");?>
</head>

<body>
    <?php
        include("./inc/nav.php");
    ?>
    <div class="container-fluid">
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
                    if(!isset($_SESSION['cart'])) {
                    echo '
                        <tr>
                            <td>#</td>
                            <td><h3 class="bottom-h">Your cart is currently empty :)</h3></td>
                            <td>#</td>
                            <td>#</td>
                        </tr>
                    ';
                    }else {
                        foreach($_SESSION['cart'] as $var) {
                        
                            $sql = "SELECT * FROM books WHERE stock_id = ".$var."";
                            $result = mysqli_query($db, $sql);
                            $array = mysqli_fetch_array($result);
                        
                            echo '
                            <tr>
                                <td>'.$array['title'].'</td>
                                <td>'.$array['author'].'</td>
                                <td>£'.$array['product_price'].'</td>
                                <td>
                                    <button class="btn" onclick="#"><span class="
                                    glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                </td>
                            </tr>
                            ';
                        };
                    }
                ?>


            </tbody>
        </table>
    </div>
    <form method="post" action="#">
        <button class="btn btn-blue" name="empty_cart">Empty Cart</button>
        <a href="checkout.php">Checkout</a>
    </form>
    <!--for testing, remove from prod -->
    <?php print_r($_SESSION['cart']);?>

    <!-- Includes universal footer -->
    <?php include("./inc/generic_footer.php");?>

</body>

</html>