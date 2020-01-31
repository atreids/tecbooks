<header>
    <div class="logo">
        <a href="index.php"><img src="./img/logo.svg"></a>
    </div>

    <nav>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <ul class="nav-links">
            <li><a class="navanchor active" href="index.php">Home</a></li>
            <li><a class="navanchor" href="#">Link</a></li>
            <li><a class="navanchor" href="#">Link</a></li>


            <div class="dropdown">
                <i class="fas fa-user-circle fa-2x drop"></i>
                <div class="dropdown-content">
                    <a href="login.php">Sign in</a>
                    <a href="register.php">Register</a>
                </div>
            </div>

        </ul>
    </nav>

    <div class="search-container">
        <form action"./inc/search.php">
            <input type="text" placeholder="Search..">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</header>