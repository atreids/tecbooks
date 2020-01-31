<?php
session_start();
if(!isset($_SESSION['login'])){
  header("location: ./index.php");
}
require("./inc/connection.php");
$user = $_SESSION['user'];
$sql = "SELECT * FROM users WHERE username = '$user'";
$data = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($data);

?>

<!doctype html>
<html lang="en">
  <head>
    <?php
      require("./inc/header.php");
    ?>
    <title><?php echo strtoupper($_SESSION['user'])?> Account</title>
  </head>
  <body>
  <?php
    include("./inc/navbar.php");
    include("./inc/footer.php");
  ?>
  
  <div class="container">
    <?php echo "<strong>Username:</strong> " . $row['username']. " <br> <strong>Email:</strong> " . $row['email'] . " <br> <strong>User Type:</strong> " . $row['usertype']; ?>
  </div>

  <div class="container">
    <form action="./php/editemail.php" method="post">
      <input type="email" name="email" placeholder="Change Email">
      <input type="submit" name="submit">
    </form>
  </div>
  

    
  </body>
</html>