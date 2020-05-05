<?php
session_start();
include("./php/connection.php");

$stock_id = $_GET['id'];
$sql = "SELECT * FROM Books WHERE stock_id = ".$stock_id."";
$result = mysqli_query($db, $sql);
$book_array = mysqli_fetch_assoc($result);

$review_sql = "SELECT * FROM Reviews JOIN Books ON Reviews.stock_id = Books.stock_id WHERE Books.stock_id = ".$stock_id."";
$review_result = mysqli_query($db, $review_sql);

if(isset($_POST['submit'])){
    $review_text = $_POST['reviewtext'];
    $stars = $_POST['stars'];
    $customer_id = $_SESSION['user_id'];

    $insert_sql = "INSERT INTO Reviews (stock_id, customer_id, review_text, stars) VALUES (".$stock_id.", ".$customer_id.", '".$review_text."', ".$stars.")";
    
    if(!mysqli_query($db,$insert_sql)) {
        die ('Error: ' .mysqli_error($db));
    }
    header("Location: ./book.php?id=".$stock_id);
}



?>
<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title><?php echo $book_array['title']; ?></title>
</head>

<body>
    <?php include("./inc/nav.php");?>
    <div class="container-fluid divider"></div>
    <div class="container margin-top">
        <div class="row">
            <div class="col-sm">
                <div class="card" style="width:20rem;">
                    <img src="<?php echo $book_array['cover']; ?>" class="card-img-top img-card" alt="Book Cover">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $book_array['title']; ?></h4>
                        <h6 class="card-subtitle mb-2"><?php echo $book_array['author']; ?></h6>
                        <p class="card-text margin-top">£ <?php echo $book_array['product_price'];?></p>
                        <p id="btn_<?php echo $book_array['stock_id'];?>"><button class="btn btn-primary"
                                onclick="loadDocCart(<?php echo $book_array['stock_id']; ?>)">Add to Cart</button></p>
                    </div>


                </div>
            </div>
            <div class="col-sm ml-2">
                <h4>Book Description</h4>
                <p><?php echo $book_array['book_desc']; ?></p>
                <?php if(isset($_SESSION['login'])) { echo '
                <form action="" method="post" class="margin-top-lg">
                    <div class="form-group w-50">
                        <h4>Leave a review</h4>
                        <label for="reviewtext" class="sr-only">Review Box</label>
                        <textarea id="reviewtext" class="form-control" type="mediumtext" name="reviewtext" rows="4"
                            required></textarea>
                        <div class="form-row margin-top">
                            <div class="form-group">
                                <label for="reviewstars">Number of Stars:</label>
                                <select name="stars" id="reviewstars" required>
                                    <option value="selection">Stars</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <input type="submit" name="submit" class="btn btn-success">
                            </div>
                        </div>
                    </div>
                </form>
                ';}?>

            </div>
        </div>
        <div class="row margin-top margin-bottom d-flex flex-row flex-wrap">
            <?php
                if(mysqli_num_rows($review_result) < 1){
                    echo '
                    <div class="alert alert-warning w-50" role="alert">This book doesn\'t have any reviews yet. Feel free to be the first!</div>
                    ';
                }else {

                while($review_array =  mysqli_fetch_assoc($review_result)){
                    echo '
                        <div class="card mr-1 margin-top" style="width:20rem">
                            <div class="card-header">Review</div>
                            <div class="card-body">
                                <p class="card-text">'.$review_array['review_text'].'</p>
                            </div>
                            <div class="card-footer">
                                <p class="card-text">Number of Stars: '.$review_array['stars'].'</p>
                            </div>
                        </div>
                    
                        ';
                    
                }}
            ?>

        </div>
    </div>


    <?php include("./inc/generic_footer.php");?>
</body>

</html>