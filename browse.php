<!--
Developed by Aaron Donaldson.
For educational purposes.
contact at ec1823622@edinburghcollege.ac.uk
-->

<?php
session_start();
require("./php/connection.php");#Includes connection to database, $db is the mysqli link
?>

<!doctype html>
<html lang="en">

<head>
    <!-- includes necessary meta tags and other data -->
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks | Books</title>
</head>

<body>
    <!--includes navbar -->
    <?php include("./inc/nav.php");?>


    <?php
    #PHP used to set up book data from database
    $sql = "SELECT * FROM Books";
    $data = mysqli_query($db, $sql);
    if (!$data) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    
    $data2 = mysqli_query($db, $sql);
    ?>


    <div class="container-fluid divider"></div>

    <!-- container containing all the books displayed on the page, and the search bar -->
    <div class="container-fluid margin-top">

        <div class="row center-flex">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6 center-flex">
                <h2><em>Browse Books</em></h2>
            </div>
            <div class="col-sm-3"></div>
        </div>


        <div class="row">

            <!-- search bar, calls a function in search.js on click -->
            <div class="col-sm-3 margin-top">
                <div class="form-group">
                    <label for="searchbar" class="sr-only">Search Bar</label>
                    <input type="text" id="searchbar" class="form-control" placeholder="Search">
                    <input type="submit" name="submit" class="btn btn-sm btn-primary margin-top" onClick="searchbar()">
                </div>
            </div>

            <!-- container containing the books, either all books or a book from a specific search -->
            <div id="book_display" class="col-sm-9 d-flex flex-row flex-wrap margin-bottom">
                <?php 
            $a = 0;
            while($array = mysqli_fetch_array($data)) { 
                #Tag data allows users to be able to search by a specific tag
                $array_of_tags[$a] = $array['tags'];
                $current_book_tags_string = $array_of_tags[$a];
                $array_of_current_books_tags = explode(",", $current_book_tags_string);
                    echo '
                    
                    <div class="card margin-top ml-5" style="width: 18rem;">
                        <img src="'.$array['cover'].'" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <a href="./book.php?id='.$array['stock_id'].'"><h5 class="card-title">'.$array['title'].'</h5></a>
                            <h6 class="card-subtitle mb-2 text-muted">'.$array['author'].'</h6>
                            <p class="card-text">£'.$array['product_price'].'</p>
                            <p id="btn_'.$array['stock_id'].'"><button class="btn btn-primary" onclick="loadDocCart('.$array['stock_id'].')">Add to Cart</button></p>
                        </div>
                    </div>
                '; 
                $a++;
            }
        ?>
            </div>

        </div>

        <!-- javascript page specific to the search function -->
        <script src="./js/search.js"></script>

        <!-- Some needed <script></script> tags -->
        <?php include("./inc/generic_footer.php");?>
</body>

</html>