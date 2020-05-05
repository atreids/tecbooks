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

    <div class="container margin-top">
        <div class="row center-flex">
            <h2><em>All Books</em></h2>
        </div>
        <div class="row d-flex flex-row flex-wrap">
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
                            <h5 class="card-title">'.$array['title'].'</h5>
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

    <?php include("./inc/generic_footer.php");?>
</body>

</html>