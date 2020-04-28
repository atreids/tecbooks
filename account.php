<?php
session_start();
require("./php/connection.php");
?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks</title>
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
                <button class="btn btn-warning">Change Email</button><br>

            </div>
            <div class="tab-pane fade" id="addresses">
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


            </div>
            <div class="tab-pane fade" id="history">...</div>
            <div class="tab-pane fade" id="reviews">...</div>
        </div>
    </div>

    <div class="container margin-top-lg margin-bottom">
        <div class="row">
            <div class="col-sm center-flex flex-column">
                <h2><em>“The more that you read, the more things you will know. The more that you learn, the more places
                        you’ll go.”</em> – Dr. Seuss</h2>
                <p>Want to get even more reading in? Next time you are in store, talk to us about signing up to our
                    monthly newsletter.
                    <br>You'll receive all sorts of news on upcoming deals!</p>
            </div>
            <div class="col-sm">
                <img src="./img/bookshelves.jpg" class="circle vsm-img">
            </div>
        </div>

        <?php include("./inc/generic_footer.php");?>
</body>

</html>