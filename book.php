<!--
Developed by Aaron Donaldson.
For educational purposes.
contact at ec1823622@edinburghcollege.ac.uk

This page is used as a detailed overview of a book, should get here by clicking on a books title
-->

<?php
session_start();
include("./php/connection.php"); #Includes connection to database, $db is the mysqli link

#Gets the book to display stock id from the url
$stock_id = $_GET['id'];

#Fetchs that books details from the database
$sql = "SELECT * FROM Books WHERE stock_id = ".$stock_id."";
$result = mysqli_query($db, $sql);
$book_array = mysqli_fetch_assoc($result);

#Fetchs any reviews about the book from the database
$review_sql = "SELECT * FROM Reviews JOIN Books ON Reviews.stock_id = Books.stock_id WHERE Books.stock_id = ".$stock_id."";
$review_result = mysqli_query($db, $review_sql);

#Runs when a new review is submitted, user has to be logged in to see the review box
if(isset($_POST['submit'])){
    #Gets review details
    $review_text = mysqli_real_escape_string($db, $_POST['reviewtext']);
    $stars = $_POST['stars'];

    #customer id from session data
    $customer_id = $_SESSION['user_id'];

    #Sets up insertion sql
    $insert_sql = "INSERT INTO Reviews (stock_id, customer_id, review_text, stars) VALUES (".$stock_id.", ".$customer_id.", '".$review_text."', ".$stars.")";
    
    #Attempts to insert review
    if(!mysqli_query($db,$insert_sql)) {
        die ('Error: ' .mysqli_error($db));
    }

    #Reloads page to display the new review
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

    <!-- contains the book, its details and its reviews -->
    <div class="container margin-top">
        <div class="row">

            <!-- column with the book's cover, title, author, price and add to cart button -->
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

            <!-- column with the books description. If the user is logged in they will also see a box where they can leave a review -->
            <div class="col-sm ml-2">
                <h4>Book Description</h4>
                <p><?php echo $book_array['book_desc']; ?></p>

                <!--review box display -->
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

        <!-- this row contains any reviews the book has received, or an alert if it hasn't received any yet -->
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

    <!-- Some needed <script></script> tags -->
    <?php include("./inc/generic_footer.php");?>
</body>

</html>