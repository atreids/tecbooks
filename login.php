<?php
#redirects if already logged in
session_start();
if(isset($_SESSION['login'])){
    header("location: ./index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/header.php");?>
    <!-- Includes universal header -->
    <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/navbar.php");?>
    <!-- Includes universal navbar -->



    <div class="container">
        <div class="inner-container" style="min-height:89vh;">
            <form action="./inc/login_pro.php" method="post">
                <label>Login</label>
                <br>
                <input type="email" name="email" placeholder="Email">
                <br>
                <input type="password" name="password" placeholder="Password">
                <br>
                <input type="submit" name="submit">
            </form>
            <?php
    if(isset($_GET['loginfailed'])) {
        echo '<h4 style="color:red;margin-top:2px;">Login failed</h4>';
    } ?>
        </div>
    </div>
    <?php include("./inc/footer.php");?>
    <!-- Includes universal footer -->
</body>

</html>