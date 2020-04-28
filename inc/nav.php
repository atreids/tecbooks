<div class="container-fluid top-line">

</div>
<div class="container-fluid center-flex">
    <a class="nav-link" href="./index.php">
        <h1 class="logo">TecBooks</h1>
    </a>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
        </ul>
        <form class="form-inline mr-1">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ml-auto">
            <?php
                        if(isset($_SESSION['login'])){
                            echo '<li class="nav-item"><a class="nav-link" href="./cart.php">CART</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="./account.php"><svg class="bi bi-people-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                            <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                          </svg></a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="./login.php">LOGIN</a></li>
                            <li class="nav-item"><a class="nav-link" href="./register.php">REGISTER</a></li>';
                        };
                    ?>
            <li class="nav-item dropdown pull-right">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    MORE
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="./contact.php">CONTACT US</a>
                    <a class="dropdown-item" href="./about.php">ABOUT US</a>
                    <?php if(isset($_SESSION['login'])) {
                        echo '<div class="dropdown-divider"></div>';
                        echo '<a class="dropdown-item" href="./php/logout.php">LOGOUT</a>';
                    }
                    ?>
                </div>
            </li>
        </ul>
    </div>
</nav>