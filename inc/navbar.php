<nav class="shadow">
    <a href="index.php" class="logo">Tecbooks</a>
    <input type="text" class="search" placeholder="Search..">
    <?php
    if(isset($_SESSION['login'])){
        echo '<a href="./inc/logout.php" class="nav-link">Logout</a>';
    } else {
        echo '<a href="login.php" class="nav-link">Login</a>
        <a href="register.php" class="nav-link">Register</a>';
    };?>

    <!-- to remove -->
    <?php
    if(isset($_SESSION['login'])) {
    echo 'User: '; echo $_SESSION['user_name'];}
    ?>
</nav>