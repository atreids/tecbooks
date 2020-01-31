<?php
session_start();
include("./inc/connection.php");
if(!isset($_SESSION['login'])){
    header("location: ./login.php");
}

$sql = "SELECT * FROM movies";
$data = mysqli_query($db, $sql);
?>

<!doctype html>
<html>
    <head>
        <?php
            require("./inc/header.php");
        ?>
        <style>
            #sel1 {
                max-width:200px;
            }
        </style>
    </head>
    <body>
        <?php
            require("./inc/navbar.php");
            include("./inc/footer.php");
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm"> 
                    <form class="form-group" action="./php/bookmovie.php" method="post">
                        <h1>Book movie</h1>
                        
                            <label for="sel1">Select Movie:</label>
                            <select class="form-control" id="sel1" name="movie">
                                <?php 
                                    while($array = mysqli_fetch_assoc($data)) {
                                    echo "<option>". $array['title'] . "</option>";
                                    }
                                ?>
                            </select>
                        
                        <p>No. Of Tickets</p>
                        <input type="number" name="tickets" placeholder="Tickets" max="100" min="1" required>
                        <br><br>
                        <button type="submit" class="btn btn-primary btn-lg" name="submit">Buy Now!</button>

                        <?php
                            if(isset($_GET['failed'])) {
                                echo '<h4 style="color:red;margin-top:2px;">Not enough tickets available, choose a lower amount.</h4>';
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>