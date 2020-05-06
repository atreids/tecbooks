<!--this is the navbar for the site -->
<nav class="navbar sticky-top navbar-expand-lg navbar-light shadow cs-nav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-4 mr-auto">
            <li class="nav-item">
                <a class="nav-link logo navbar-text" href="./index.php">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./browse.php">
                    Browse Books
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./about.php">
                    About Tecbooks
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./contact.php">
                    Contact Us
                </a>
            </li>
        </ul>
        <ul class="navbar-nav mr-4 ml-auto">
            <?php
            #This php changes what appears on the right hand side of the navbar depending on if they user is logged in or not
                        if(isset($_SESSION['login'])){
                            $cart_number = 0;
                            if(isset($_SESSION['cart']) and !empty($_SESSION['cart'])){
                                for($x=1;$x <= count($_SESSION['cart']); $x = $x + 2) {
                                
                                $cart_number = $cart_number + $_SESSION['cart'][$x];
                                }
                            }
                            if($_SESSION['login'] == 'admin'){
                                echo '<li class="nav-item"><a class="nav-link" href="./admin.php">Admin</a></li>';
                            }
                            echo '<li class="nav-item"><a class="nav-link" href="./cart.php">Cart</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="./account.php"><svg class="bi bi-people-circle" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                            <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                          </svg></a></li>';
                          echo '<li class="nav-item"><a class="nav-link" href="./php/logout.php">Logout</a></li>';
                        } else {
                            echo '
                            <li class="nav-item"><a class="nav-link" href="./register.php">Register</a></li>
                            <li class="nav-item"><a class="nav-link" href="./login.php">Login</a></li>
                            ';
                        };
                    ?>
        </ul>
    </div>
</nav>