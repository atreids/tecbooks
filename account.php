<?php
session_start();
include("./inc/connection.php");

if(!isset($_SESSION['login'])){
    header("location: ./index.php");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!doctype html>
<html lang="en">

<head>
    <?php 
        include("./inc/header.php");
    ?> <!-Includes basic header->
        <script src="https://kit.fontawesome.com/6c30bf13b8.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="./css/style.css">
        <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/navbar.php");?>
    <!-- Includes universal navbar -->

    <div class="container redbackground">
        <div class="inner-container">
            <h2>Welcome to your account page</h2>
        </div>
    </div>

    <div class="container navybackground">
        <div class="inner-container-wide med-height navybackground">
            <div class="col-30 ">
                <h3>Manage Account:</h3>
                <ul class="btn-list">
                    <li><button id="vdetails" class="btn btn-active"
                            onclick="loadDoc('./inc/displayDetails.php', v_accountDetails)">
                            View Your Details</button></li>
                    <li><button id="vaddresses" class="btn"
                            onclick="loadDoc('./inc/displayAddresses.php', v_addressDetails)">
                            View Your Addresses</button></li>
                    <li><button id="vpayments" class="btn"
                            onclick="loadDoc('./inc/displayPayments.php', v_paymentDetails)">
                            View Payment Methods</button></li>
                    <li><button id="delete" class="btn">Delete Account</button></li>
                </ul>
            </div>
            <div class="col-70" id="ajax">
                <?php
                    $id = $_SESSION['user_id'];
                    $query = "SELECT firstname, surname, email FROM Customers WHERE customer_id = '$id'";
                    $result = mysqli_query($db,$query);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    echo "Name: " . $row['firstname'] . " " . $row['surname'] . "<br>";
                    echo "Email: " . $row['email'] . "<br>";
                    echo '<form action="javascript:updateEmail()" method="post">';
                    echo '<input id="newemail" class="input" type="email" placeholder="update email.." name="newemail"><br>';
                    echo '<input type="submit" class="btn" name="submit">';
                    echo '</form>';
                    echo '<div class="msg"></div>';
                ?>
            </div>
        </div>
    </div>

    <div id="para3" class="img-3 parrallax short-height">
    </div>

    <div class="container navybackground">
        <div class="inner-container med-height navybackground">
            <div class="col">
                <h3>We all read a little different</h3>
                <p>But no matter how you read, we are here to help to get you your books on-time and
                    at a great price! Leaving you more time for that next chapter!
                </p>
            </div>
            <div class="col">
                <img src="./img/help.jpg" class="circle vsm-img">
            </div>
        </div>
    </div>

    <script src="./js/account.js"></script>
    <?php include("./inc/footer.php");?>
    <!-- Includes universal footer -->
</body>

</html>