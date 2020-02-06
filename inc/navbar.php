<nav class="nav-shadow">
    <a href="index.php" class="logo">Tecbooks</a>
    <input type="text" class="search" placeholder="Search..">
    <a href="account.php" class="nav-link">Account</a>
    <a href="contact.php" class="nav-link">Contact</a>
    <a href="basket.php" class="nav-link">Cart</a>
    <?php
    if(isset($_SESSION['login'])){
        echo '<a href="./inc/logout.php" class="nav-link">Logout</a>';
    } else {
        echo '<a href="login.php" class="nav-link">Login</a>
        <a href="register.php" class="nav-link">Register</a>';
    };?>

    <?php 
        if(isset($_SESSION['login']) and $_SESSION['login'] == 'admin') {
            echo '<a href="admin.php" class="nav-link">Admin</a>';
        }
        ?>
</nav>