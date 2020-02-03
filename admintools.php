<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ./login.php");
}
include("./inc/connection.php");
?>

<!doctype html>
<html>
    <head>
        <?php
            require("./inc/header.php");
        ?>
        
        <title>Admin Panel</title>
        <!--Script for displaying users/movies without reloading page-->
        <script>
            function showUser(str) {
                document.getElementById("display_user").innerHTML = str;
                if (str == "") {
                    document.getElementById("display_user").innerHTML = "";
                    return;
                } else {
                    xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("display_user").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET","./php/getuser.php?q="+str,true);
                    xmlhttp.send();
                }
            }
            
            function showMovie(str) {
                document.getElementById("display_movie").innerHTML = str;
                if (str == "") {
                    document.getElementById("display_movie").innerHTML = "";
                    return;
                } else {
                    xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("display_movie").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET","./php/getmovie.php?q="+str,true);
                    xmlhttp.send();
                }
            }

            function showMovie2(str) {
                document.getElementById("editmovie").innerHTML = str;
                if (str == "") {
                    document.getElementById("editmovie").innerHTML = "";
                    return;
                } else {
                    xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("editmovie").appendchild = this.responseText;
                        }
                    };
                    xmlhttp.open("GET","./php/editgetmovie.php?q="+str,true);
                    xmlhttp.send();
                }
            }
        </script>

        <link rel="stylesheet" href="./css/admincss.css">
    </head>
    <body>
        <?php
            require("./inc/navbar.php");
            include("./inc/footer.php");
        ?>

        <div class="container">
            <div class="row"> 
                <div class="col-sm-4">
                    <form action="./php/addmovie.php" method="post">
                        <h3>Add a Movie</h3>
                        <p>Title</p>
                        <input type="text" name="title" placeholder="Title" required autofocus>
                        <p>Image Name</p>
                        <input type="text" name="image" placeholder="Image">
                        <p>Brief Description</p>
                        <input type="text" name="briefdesc" placeholder="Brief Desc" required>
                        <p>Long Decription</p>
                        <input type="text" id="longdesc" name="longdesc" placeholder="Long Desc" required>
                        <p>Tickets Available</p>
                        <input type="number" name="tickets" placeholder="Tickets" required>
                        <br>
                        <input class="submit" type="submit" name="submitmovie">
                    </form>
                </div>
                <div class="col-sm-4">
                    <div class="bodylog">
                        <form action="./php/adminreg.php" method="post">
                            <h3>Register an Admin</h3>
                            <p>Create Username</p>
                            <input type="text" name="username" placeholder="Create Username" required autofocus>
                            <p>Enter Email</p>
                            <input type="email" name="email" placeholder="Enter Email" required>
                            <p>Password</p>
                            <input type="password" name="password" placeholder="Create Password" required>
                            <p>Repeat Password</p>
                            <input type="password" name="repeatpassword" placeholder="Repeat Password" required>
                            <br>
                            <input class="submit" type="submit" name="submitadmin">
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <form action="./php/deleteaccount.php"method="post">
                        <h3>View Users</h3>
                        <select class="form-control sel1" name="deluser" onchange="showUser(this.value)">
                            <?php
                                $sql = "SELECT * FROM users";
                                $data = mysqli_query($db,$sql);
                                while($array = mysqli_fetch_assoc($data)) {
                                echo "<option>". $array['username'] . "</option>";
                                }
                            ?>
                        </select>
                        <p id="display_user"></p>
                        <button class="delbutton" type="submit">Delete Account</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <form action="./php/deletemovie.php" method="post">
                        <h3>Delete Movies</h3>
                        <select class="form-control sel1" name="delmovie" onchange="showMovie(this.value)">
                            <?php
                                $sqlm = "SELECT * FROM movies";
                                $datam = mysqli_query($db,$sqlm);
                                while($arraym = mysqli_fetch_assoc($datam)) {
                                echo "<option>". $arraym['title'] . "</option>";
                                }
                            ?>
                        </select>
                        <p id="display_movie"></p>
                        <button class="delbutton" type="submit">Delete Movie</button>
                    </form>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-4">
                    <form action="./php/editmovie.php" id="editmovie" method="post">
                        <h3>Edit Movies</h3>
                        <select class="form-control sel1" name="upmovie" onchange="showMovie2(this.value)">
                            <?php
                                $sqlm = "SELECT * FROM movies";
                                $datam = mysqli_query($db,$sqlm);
                                while($arraym = mysqli_fetch_assoc($datam)) {
                                echo "<option>". $arraym['title'] . "</option>";
                                }
                            ?>
                        </select>
                        <button type="submit">Update Movie</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>