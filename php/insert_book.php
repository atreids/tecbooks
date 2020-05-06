<?php
//
//
//Needed for admin.php
//Called from new_book() in admin.js
//Inserts a new book into the database
//
//


#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../index.php");
}
require("./connection.php");

#User entered book details
$title = mysqli_real_escape_string($db, $_POST['title']);
$author = $_POST['author'];
$cover = mysqli_real_escape_string($db, $_POST['cover']);
$isbn = $_POST['isbn'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$tags = $_POST['tags'];
$desc = mysqli_real_escape_string($db, $_POST['desc']);


#Sets up insertion sql
$insertion_sql =
"INSERT INTO Books(title, author, isbn, book_desc, cover, quantity_stock, product_price, tags) VALUES 
(\"".$title."\", 
\"".$author."\", 
\"".$isbn."\", 
\"".$desc."\",
\"".$cover."\", 
".$quantity.", 
".$price.", 
\"".$tags."\"
)
";

#Attempts to insert the book
if(!mysqli_query($db,$insertion_sql)) {
    die ('Error: ' .mysqli_error($db));
}else {
    mysqli_close($db);
}
?>