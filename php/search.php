<?php
#Called from ajax from browse.php and search.js
#Used to search for a book by title, author, isbn or tag

session_start();
require("./connection.php");
#gets the searchterm
$searchterm = $_POST['searchterm'];
#array we will store the books that match the search term
$returned_books_ids = array();
$sql = "SELECT stock_id, title, author, isbn, tags FROM Books";
$result = mysqli_query($db, $sql);

#Some variables used in the while loop
$i = 0;
$a = 0;

#While loop searchs through all books in the database, trying to match the searchterm exactly to the title, author, isbn or tag
while($array = mysqli_fetch_array($result)) {
    if($searchterm == $array['title']) {
        $returned_books_ids[$i] = $array['stock_id'];
        $i++;
    }
    if($searchterm == $array['author']) {
        $returned_books_ids[$i] = $array['stock_id'];
        $i++;
    }
    if($searchterm == $array['isbn']) {
        $returned_books_ids[$i] = $array['stock_id'];
        $i++;
    }
    $array_of_tags[$a] = $array['tags'];
    $current_book_tags_string = $array_of_tags[$a];
    $array_of_current_books_tags = explode(",", $current_book_tags_string);
    if(in_array($searchterm, $array_of_current_books_tags)) {
        $returned_books_ids[$i] = $array['stock_id'];
        $i++;
    }
    $a++;
}

if($i == 0) {
    #If nothing matched, echo this response
    echo 'No books were found for that search term';
}else {
    #Else for each book found display the book in a nicely formatted card
    foreach($returned_books_ids as $value){
    $sql2 = "SELECT * FROM Books WHERE stock_id = ".$value."";
    $data =  mysqli_query($db, $sql2);
    if(!$data) {

    }else {
    while($array = mysqli_fetch_array($data)) { 
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
    }}
}
}