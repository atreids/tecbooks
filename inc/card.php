<?php
$sql = "SELECT * FROM books";
$data = mysqli_query($db, $sql);
$data2 = mysqli_query($db, $sql);
?>


<div class="container">
    <div class="row book-header">
        <h2><em>New In Stock</em></h2>
    </div>

    <div class="row panel padding-top">
        <?php 
            $a = 0;
            while($array = mysqli_fetch_array($data)) { 
                $array_of_tags[$a] = $array['tags'];
                $current_book_tags_string = $array_of_tags[$a];
                $array_of_current_books_tags = explode(",", $current_book_tags_string);
                if(in_array("New", $array_of_current_books_tags)) {
                    echo '
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="'.$array['cover'].'" alt="..." class="book-img">
                                <div class="caption">
                                    <h3>'.$array['title'].'</h3>
                                    <p>'.$array['book_desc'].'</p>
                                    <p><em>Price: £'.$array['product_price'].'</em></p>
                                    <p><a href="#" class="btn btn-blue" role="button">Add To Cart</a>
                                </div>
                            </div>
                        </div>';
                }
                $a++;
            }
        ?>

    </div>

    <div class="row book-header">
        <h2><em>Our Bestsellers</em></h2>
    </div>

    <div class="row panel padding-top">

        <?php 
            $a = 0;
            while($array2 = mysqli_fetch_array($data2)) { 
                $array_of_tags[$a] = $array2['tags'];
                $current_book_tags_string = $array_of_tags[$a];
                $array_of_current_books_tags = explode(",", $current_book_tags_string);
                if(in_array("Bestseller", $array_of_current_books_tags)) {
                    echo '
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <img src="'.$array2['cover'].'" alt="..." class="book-img">
                                <div class="caption">
                                    <h3>'.$array2['title'].'</h3>
                                    <p>'.$array2['book_desc'].'</p>
                                    <p><em>Price: £'.$array2['product_price'].'</em></p>
                                    <p><a href="#" class="btn btn-blue" role="button">Add To Cart</a>
                                </div>
                            </div>
                        </div>';
                }
                $a++;
            }
        ?>
    </div>

    <div class="row book-header center-text">
        <h2><em>Browse Our Full Selection</em></h2>
    </div>

    <div class="row center-text">
        <a href="./browse.php"><button class="btn btn-default btn-lg btn-blue">Browse</button></a>
    </div>

</div>