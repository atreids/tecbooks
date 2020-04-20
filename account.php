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
        <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/navbar.php");?>
    <link rel="stylesheet" href="./css/logincss.css">
    <!-- Includes universal navbar -->

    <div class="divider">

    </div>

    <div class="container-fluid flex-boi account-div">
        <div class="row center-text">
            <div class="col-sm-4 center-text vertical margin-right">
                <h3 class="bottom-h">Manage Account</h3>
                <ul class="btn-list">
                    <li><button id="vdetails" class="btn btn-blue btn-active"
                            onclick="loadDoc('./inc/displayDetails.php', v_accountDetails)">
                            View Your Details</button></li>
                    <li><button id="vaddresses" class="btn btn-blue"
                            onclick="loadDoc('./inc/displayAddresses.php', v_addressDetails)">
                            View Your Addresses</button></li>
                    <li><button id="vpayments" class="btn btn-blue"
                            onclick="loadDoc('./inc/displayPayments.php', v_paymentDetails)">
                            View Payment Methods</button></li>
                    <li><button id="delete" class="btn">Delete Account</button></li>
                </ul>
            </div>
            <div class="col-sm-8 panel center-text vertical" id="ajax">
                <?php
                    $id = $_SESSION['user_id'];
                    $query = "SELECT firstname, surname, email FROM Customers WHERE customer_id = '$id'";
                    $result = mysqli_query($db,$query);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    echo "Name: " . $row['firstname'] . " " . $row['surname'] . "<br>";
                    echo "Email: " . $row['email'] . "<br>";
                    echo '<form action="javascript:updateEmail()" method="post">';
                    echo '<input id="newemail" class="form-control" type="email" placeholder="Update Email.." name="newemail" required autofocus><br>';
                    echo '<input type="submit" class="btn btn-blue" name="submit">';
                    echo '</form>';
                    echo '<div class="msg"></div>';
                ?>
            </div>
        </div>
    </div>

    <div class="divider"></div>

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