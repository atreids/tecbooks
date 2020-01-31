
<!--Code for static navbar-->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="./index.php">
        <img src="./img/playbutton.png" width="30" height="30" alt="Home">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!--Buttons on the left side of the navbar-->
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./aboutus.php">About Us</a>
            </li>

            <?php if(isset($_SESSION['login'])){
                echo '<li class="nav-item">
                    <a class="nav-link" href="./accountpage.php">',ucfirst($_SESSION['user']),'</a>
                </li>';
            }
            ?>
        </ul>
    </div>

    <!--Optional buttons based on login state, on the right of navbar-->
    <?php 
    #admin button
    if(isset($_SESSION['login'])){
        if($_SESSION['login'] == "admin"){
            echo '<div class="pull-right">
                <ul class="nav navbar-nav">
                    <li><a class="nav-link" href="./admintools.php">Admin</a></li>
                </ul>
            </div>';
        }
    }
    #login,logout, register buttons
    if(isset($_SESSION['login'])){
        echo '<div class="pull-right">
            <ul class="nav navbar-nav">
                <li><a class="nav-link" href="./php/logout.php">Logout</a></li>
            </ul>
        </div>';
    } else {
        echo '<div class="pull-right">
                <ul class="nav navbar-nav">
                    <li><a class="nav-link" href="./login.php">Login</a></li>
                </ul>
            </div>
            <div class="pull-right">
                <ul class="nav navbar-nav">
                    <li><a class="nav-link" href="./registration.php">Register</a></li>
                </ul>
            </div>';
    }
    ?>
</nav>