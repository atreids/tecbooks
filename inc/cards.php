<?php
$sql = "SELECT * FROM books";
$data = mysqli_query($db, $sql);
$data2 = mysqli_query($db, $sql);
?>

<div class="container">
    <div class="row center-flex">
        <h2><em>Our Bestsellers</em></h2>
    </div>
    <div class="row">
        <?php 
            $a = 0;
            while($array = mysqli_fetch_array($data)) { 
                $array_of_tags[$a] = $array['tags'];
                $current_book_tags_string = $array_of_tags[$a];
                $array_of_current_books_tags = explode(",", $current_book_tags_string);
                if(in_array("Bestseller", $array_of_current_books_tags)) {
                    echo '
                    <div class="col-sm">
                    <div class="card" style="width: 18rem;">
                        <img src="'.$array['cover'].'" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">'.$array['title'].'</h5>
                            <h6 class="card-subtitle mb-2 text-muted">'.$array['author'].'</h6>
                            <p class="card-text">£'.$array['product_price'].'</p>
                            <p id="btn_'.$array['stock_id'].'"><button class="btn btn-primary" onclick="loadDocCart('.$array['stock_id'].')">Add to Cart</button></p>
                        </div>
                    </div>
                </div>';
                }
                $a++;
            }
        ?>
    </div>
    <?php print_r($_SESSION['cart']);?>
    <div class="row center-flex">
        <h2><em>New In Stock</em></h2>
    </div>
    <div class="row">
        <?php 
            $a = 0;
            while($array2 = mysqli_fetch_array($data2)) { 
                $array_of_tags[$a] = $array2['tags'];
                $current_book_tags_string = $array_of_tags[$a];
                $array_of_current_books_tags = explode(",", $current_book_tags_string);
                if(in_array("New", $array_of_current_books_tags)) {
                    echo '
                    <div class="col-sm">
                    <div class="card" style="width: 18rem;">
                        <img src="'.$array2['cover'].'" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">'.$array2['title'].'</h5>
                            <h6 class="card-subtitle mb-2 text-muted">'.$array2['author'].'</h6>
                            <p class="card-text">£'.$array2['product_price'].'</p>
                            <p id="btn_'.$array2['stock_id'].'"><button class="btn btn-primary" onclick="loadDocCart('.$array2['stock_id'].')">Add to Cart</button></p>
                        </div>
                    </div>
                </div>';
                }
                $a++;
            }
        ?>
    </div>
</div>