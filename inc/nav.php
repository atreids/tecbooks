<div class="container-fluid top-line">

</div>
<div class="container-fluid center-flex">
    <a class="nav-link" href="./index.php">
        <h1 class="logo">TecBooks</h1>
    </a>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">HOME <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./browse.php?tags=Bestsellers">BESTSELLERS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./browse.php?tags=ComputerScience">COMPUTER SCIENCE</a>
            </li>
            <?php
                        if(isset($_SESSION['login'])){
                            echo '<li class="nav-item"><a class="nav-link" href="./cart.php">CART</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="./account.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="./php/logout.php">LOGOUT</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="./login.php">LOGIN</a></li>
                            <li class="nav-item"><a class="nav-link" href="./register.php">REGISTER</a></li>';
                        };
                    ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    MORE
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="./contact.php">CONTACT US</a>
                    <a class="dropdown-item" href="./about.php">ABOUT US</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
    </div>
</nav>