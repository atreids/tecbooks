<?php
session_start();
require("./php/connection.php");
?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/nav.php");?>
    <?php
    $sql = "SELECT * FROM Books";
    $data = mysqli_query($db, $sql);
    if (!$data) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    
    $data2 = mysqli_query($db, $sql);
    ?>
    <div class="container-fluid divider"></div>

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
            <div class="col-sm-3 margin-top">
                <div class="form-group">
                    <label for="searchbar" class="sr-only">Search Bar</label>
                    <input type="text" id="searchbar" class="form-control" placeholder="Search">
                    <input type="submit" name="submit" class="btn btn-sm btn-primary margin-top" onClick="searchbar()">
                </div>
            </div>
            <div id="book_display" class="col-sm-9 d-flex flex-row flex-wrap margin-bottom">
                <?php 
            $a = 0;
            while($array = mysqli_fetch_array($data)) { 
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

        <script src="./js/search.js"></script>
        <?php include("./inc/generic_footer.php");?>
</body>

</html>