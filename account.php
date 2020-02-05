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

    <div id="para3" class="img-3 parrallax short-height">
    </div>

    <div class="container navybackground">
        <div class="inner-container med-height navybackground">
            <div class="col">
                <h3>View Account:</h3>
                <ul class="btn-list">
                    <li id="vdetails" class="btn" onclick="loadDoc('./inc/displayDetails.php', v_accountDetails)">
                        View Your Details</li>
                    <li id="vaddresses" class="btn" onclick="loadDoc('./inc/displayAddresses.php', v_addressDetails)">
                        View Your Addresses</li>
                    <li id="vpayments" class="btn" onclick="loadDoc('./inc/displayPayments.php', v_paymentDetails)">
                        View Payment Methods</li>
                </ul>
                <h3>Edit details:</h3>
                <ul class="btn-list">
                    <li id="details" class="btn" onclick="loadDoc('./inc/updatedetails.php', accountDetails)">
                        Update Details</li>
                    <li id="addresses" class="btn" onclick="loadDoc('./inc/updateAddress.php', addressDetails)">
                        Update Addresses</li>
                    <li id="payments" class="btn" onclick="loadDoc('./inc/updatePayments.php', paymentDetails)">
                        Update Payment</li>

                </ul>
            </div>
            <div class="col" id="ajax">
                <?php
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT firstname, surname, email FROM Customers WHERE customer_id = '$user_id'";
                    $result = mysqli_query($db,$query);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    echo "<table>
                    <tr>
                    <th>Name</th>
                    <th>Email</th>
                    </tr>";
                    echo "<tr><td>" .$row['firstname'] . " " . $row['surname'] . "</td>
                            <td>" . $row['email'] . "</td>
                    </tr></table>";
                ?>
            </div>
        </div>
    </div>

    <div class="border-red"></div>

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