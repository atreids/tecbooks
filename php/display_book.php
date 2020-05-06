<?php
#Displays a book and it's details to be managed or deleted
#Called from admin.php through ajax

session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ../index.php");
}


require("./connection.php");

#receives the id of the book and retrieves its details
$stock_id = $_POST['stock_id'];
$retrieve_book = "SELECT * FROM Books WHERE stock_id = ".$stock_id."";
$result = mysqli_query($db,$retrieve_book);
$array = mysqli_fetch_assoc($result);

#This entire echo response is placed inside a table body on admin.php
#Includes some buttons that perform calls to functions in admin.js
echo '
<tr>
    <td>'.$array['stock_id'].'</td>
    <td>'.$array['title'].'</td>
    <td>'.$array['author'].'</td>
    <td>'.$array['product_price'].'</td>
    <td>'.$array['quantity_stock'].'</td>
    <td>
    <button class="btn btn-secondary" onClick="show_desc()">Show Desc/Cover URL</button>
    <button class="btn btn-success" onClick="edit_book_show()">Edit</button>
    </td>
    <td><button class="btn btn-danger" onClick="delete_book('.$array['stock_id'].')">Delete</button></td>
</tr>
<tr id="desc_row" class="d-none">
<td>Description: </td>
<td>'.$array['book_desc'].'</td>
<td>#####</td>
<td>Cover URL:</td>
<td>'.$array['cover'].'</td>
<td>#####</td>
<td>#####</td>
</tr>
<tr id="edit_row1" class="d-none">
    <td>####</td>
    <td><input type="text" class="form-control" id="edited_title_'.$stock_id.'" value="'.$array['title'].'"></td>
    <td><input type="text" class="form-control" id="edited_author_'.$stock_id.'" value="'.$array['author'].'"></td>
    <td><input type="number" step="0.01" class="form-control" id="edited_price_'.$stock_id.'" value="'.$array['product_price'].'"></td>
    <td><input type="number" class="form-control" id="edited_quantity_'.$stock_id.'" value="'.$array['quantity_stock'].'"></td>
    <td>#####</td>
    <td>#####</td>
</tr>
<tr id="edit_row2" class="d-none">
<td>#####</td>
<td><input id="edited_desc_'.$stock_id.'" type="textarea" class="form-control" value="'.$array['book_desc'].'"></td>
<td><input id="edited_cover_'.$stock_id.'" type="text" class="form-control" value="'.$array['cover'].'"></td>
<td>#####</td>
<td>#####</td>
<td>#####</td>
<td><button class="btn btn-success" onClick="edit_book_submit('.$array['stock_id'].')">Submit</button></td>
</tr>
';

?>