<div class="container-fluid top-line">

</div>
<div class="container-fluid center-text">
    <h1 class="logo">TecBooks</h1>
</div>
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="./index.php">HOME</a></li>
                <li><a href="./browse.php">BESTSELLERS</a></li>
                <li><a href="./browse.php">MATHEMATICS</a></li>
                <li><a href="./browse.php">COMPUTER SCIENCE</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        CATEGORIES</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">NEW</a></li>
                        <li><a href="#">BIOLOGY</a></li>
                        <li><a href="#">ARCHITECTURE</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                        if(isset($_SESSION['login'])){
                            echo '<li><a href="./inc/cart.php">CART</a></li>';
                            echo '<li><a href="./inc/logout.php">LOGOUT</a></li>';
                        } else {
                            echo '<li><a href="login.php">LOGIN</a></li>
                            <li><a href="register.php">REGISTER</a></li>';
                        };
                    ?>
            </ul>
        </div>
        <!--End of navbar collapse-->
    </div>
</nav>