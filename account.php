<?php
session_start();
require("./inc/connection.php");

if(!isset($_SESSION['login'])){
    header("location: ./index.php");
}
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
    <div class="content">
        <?php
            include("./inc/navbar.php");
        ?>

        <div class="bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Hello <?php echo $_SESSION['user'];?></h1>
                    <h2>Here you can edit your account, view your purchase history, amend purchase details and more.
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1>Your Details:</h1>
                    <button class='btn btn-lg btn-primary btn-block' name='personal' id='personal'>Personal
                        Details</button>
                    <button class='btn btn-lg btn-primary btn-block' name='address' id='address'>Addresses</button>
                    <button class='btn btn-lg btn-primary btn-block' name='payment' id='payment'>Payment
                        Methods</button>

                </div>
                <div class="col">
                    <h1>col 2</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Nisl nunc mi ipsum faucibus. Fringilla urna porttitor rhoncus
                        dolor purus. Elit sed vulputate mi sit amet mauris. Gravida quis blandit turpis cursus in hac
                        habitasse platea dictumst. Arcu risus quis varius quam quisque id diam vel. Nisl condimentum id
                        venenatis a. Ac turpis egestas integer eget aliquet nibh. Massa enim nec dui nunc mattis.
                        Pharetra convallis posuere morbi leo urna molestie. Semper eget duis at tellus at urna
                        condimentum. Nisl nunc mi ipsum faucibus vitae aliquet. Sem et tortor consequat id porta nibh
                        venenatis cras. Aliquet porttitor lacus luctus accumsan tortor posuere. At urna condimentum
                        mattis pellentesque id nibh tortor id aliquet. Eget lorem dolor sed viverra ipsum nunc aliquet
                        bibendum. Id donec ultrices tincidunt arcu non sodales neque.

                        Lacus viverra vitae congue eu consequat. Feugiat scelerisque varius morbi enim. Quam quisque id
                        diam vel quam elementum pulvinar. Aliquam etiam erat velit scelerisque in dictum. Cras pulvinar
                        mattis nunc sed blandit libero. A diam sollicitudin tempor id eu nisl nunc mi. Porttitor lacus
                        luctus accumsan tortor. Pellentesque dignissim enim sit amet venenatis urna cursus eget.
                        Suspendisse interdum consectetur libero id faucibus nisl. Consectetur adipiscing elit duis
                        tristique sollicitudin nibh. Sed libero enim sed faucibus turpis in eu. In nibh mauris cursus
                        mattis molestie a iaculis. Aliquam id diam maecenas ultricies mi eget mauris pharetra. Proin
                        fermentum leo vel orci porta non pulvinar neque laoreet. Commodo odio aenean sed adipiscing diam
                        donec adipiscing. Accumsan tortor posuere ac ut consequat semper viverra. Sit amet tellus cras
                        adipiscing enim eu turpis egestas pretium. Volutpat lacus laoreet non curabitur. Posuere lorem
                        ipsum dolor sit. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed velit.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include("./inc/scripts.php");?>
</body>

</html>