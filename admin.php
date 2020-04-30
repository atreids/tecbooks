<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ./index.php");
}
require("./php/connection.php"); #Includes connection to database, $db is variable for connection.
?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks</title>
</head>

<body class="d-flex flex-column">
    <?php include("./inc/nav.php");?>
    <div class="container-fluid divider"></div>
    <div class="container margin-top">
        <div class="alert alert-danger margin-top center-flex" role="alert">
            <b>Alert:</b> This is the live admin panel. Any changes here will be reflected immediately on the live site!
            Please double check all changes before submission.
        </div>
        <!--Tabs with different admin actions by grouping -->
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#stock">Manage Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#users">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#orders">Manage Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#admins">Manage Admins</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="stock">
                <div class="container-fluid margin-top">

                    <!--Buttons to decide how to manage stock -->
                    <div class="row">
                        <div class="col-sm center-flex">
                            <button class="btn btn-warning" onClick="toggle_existing_books()">Manage Existing
                                Books</button>
                        </div>
                        <div class="col-sm center-flex">
                            <button class="btn btn-warning" onClick="toggle_new_book_form()">Add A New Book</button>
                        </div>
                    </div>




                    <!--Form for adding a new book -->
                    <div id="book_inserted_alert" class="alert alert-success w-50 margin-top d-none" role="alert">
                        Book Submitted!
                    </div>
                    <form id="new_book_form" class="d-none margin-top" action="javascript:new_book()">
                        <h1 class="h3 mb-3 font-weight-normal">Add New Book</h1>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Title</label>
                                <input class="form-control" id="title" type="text" name="title" placeholder="Dune"
                                    required autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="author">Author</label>
                                <input class="form-control" type="text" id="author" name="author"
                                    placeholder="Frank Herbert" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cover">Cover image url</label>
                            <input type="text" id="cover" name="cover" class="form-control"
                                placeholder="Ensure it's the exact url for the image itself" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="isbn">ISBN (ISBN-10 Format)</label>
                                <input type="number" class="form-control" id="isbn" name="isbn" placeholder="ISBN-10"
                                    required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    placeholder="500">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    placeholder="8.99" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags (Enter with no spaces, seperated by commas)</label>
                            <input type="text" class="form-control" id="tags" name="tags"
                                placeholder="BestSeller,New,ScienceFiction" required>
                        </div>
                        <div class="form-group">
                            <label for="desc">Book Description</label>
                            <textarea class="form-control" id="desc" name="desc" rows="5" required></textarea>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary">
                        <p class="mt-5 mb-3 text-muted">Tecbooks &copy; 2019-2020</p>
                    </form>


                    <!-- Code for managing existing books -->
                    <div class="container-fluid d-none" id="existing_books">
                        <div class="row margin-top">
                            <form class="col-sm center-flex">
                                <label for="selectbook" class="sr-only"></label>
                                <select id="selectbook" class="form-control" onChange="display_book(this.value)">
                                    <option value="0">Select Book</option>
                                    <?php
                                        $get_books = "SELECT * FROM Books ORDER BY title ASC";
                                        $get_books_result = mysqli_query($db,$get_books);
                                        while($get_books_array = mysqli_fetch_assoc($get_books_result)) {
                                            echo '<option value='.$get_books_array['stock_id'].'>'.$get_books_array['title'].' // '.$get_books_array['author'].'</option>';
                                        }
                                    ?>
                                </select>
                            </form>
                            <form class="col-sm center-flex">
                                <form class="form-row">
                                    <label for="search" class="sr-only"></label>
                                    <input class="form-control" type="text" id="search" placeholder="Search" required>
                                    <button class="btn btn-secondary ml-1" onClick="">Search</button>
                                </form>
                            </form>
                        </div>
                        <div id="book_edited_alert" class="alert alert-success w-50 margin-top d-none" role="alert">
                            Database Edited!
                        </div>
                        <table id="existing_book_table" class="table table-striped margin-top d-none">
                            <thead>
                                <tr>
                                    <th scope="col">Stock ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">####</th>
                                    <th scope="col">####</th>
                                </tr>
                            </thead>
                            <tbody id="table_body" class="table-primary">
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="users">
                <div class="container-fluid margin-top">
                    <div class="row margin-top">
                        <form class="col-sm center-flex">
                            <label for="selectbook" class="sr-only"></label>
                            <select id="selectbook" class="form-control" onChange="display_book(this.value)">
                                <option value="0">Select User</option>
                                <?php
                                        $get_users = "SELECT * FROM Customers ORDER BY firstname ASC";
                                        $get_users_result = mysqli_query($db,$get_users);
                                        while($get_users_array = mysqli_fetch_assoc($get_users_result)) {
                                            echo '<option value='.$get_users_array['customer_id'].'>'.$get_users_array['customer_id'].' '.$get_users_array['firstname'].' '.$get_users_array['surname'].'</option>';
                                        }
                                    ?>
                            </select>
                        </form>
                        <form class="col-sm center-flex">
                            <form class="form-row">
                                <label for="search" class="sr-only"></label>
                                <input class="form-control" type="text" id="search" placeholder="Search" required>
                                <button class="btn btn-secondary ml-1" onClick="">Search</button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="orders">

                orders
            </div>
            <div class="tab-pane fade" id="admins">...</div>
            </button>
        </div>
        <script src="./js/admin.js"></script>
        <?php include("./inc/generic_footer.php");?>
</body>

</html>