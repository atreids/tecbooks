<?php
session_start();
#Redirects if not an admin
if($_SESSION['login'] != "admin"){
    header("location: ./index.php");
}
require("./php/connection.php"); #Includes connection to database, $db is variable for connection.

#For registering new admin
if(isset($_POST['submit_admin'])) {

    
    #Variables entered by user
    $email = $_POST['inputEmail'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $address1 = $_POST['inputAddress'];
    $address2 = $_POST['inputAddress2'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zip = $_POST['zip'];


    #Password is hashed using BCRYPT
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $repeatpassword = $_POST['repeatpassword'];


    #This query will be used to see if the email is already registered
    $query = "SELECT * FROM Customers WHERE email ='$email'";
    $result = mysqli_query($db,$query);
    
    if (mysqli_num_rows($result)>0) { #Checks if resulting row >0, meaning email exists
        header("location: ./register.php?uex=1"); #returns to register with an error
    }elseif (!password_verify($repeatpassword, $pass)) { #Verifying the passwords match
        header("location: ./register.php?pm=1");
    }else {

        #Insert customers data into database
        $sql = "INSERT INTO Customers (firstname, surname, hashed_pass, email, user_type) VALUES
        ('$fname','$lname','$pass','$email','1')";
        mysqli_query($db,$sql);
        #Check if address exists, if so uses that, if not inserts new address
        $sql_address_id = "SELECT * FROM Addresses WHERE address1 LIKE '".$address1."' AND city LIKE
        '".$city."' AND zip_postcode LIKE '".$zip."' and country LIKE '".$country."' AND address2 LIKE '".$address2."'";
        $result = mysqli_query($db, $sql_address_id);
        if(!mysqli_num_rows($result)>0){
            #Insert new address
            $sql_address = "INSERT INTO Addresses (address1, address2, city, zip_postcode, country) VALUES
            ('$address1','$address2','$city','$zip','$country')";
            mysqli_query($db,$sql_address);
            #Get that new addresses address_id
            $result = mysqli_query($db, $sql_address_id);
            $array = mysqli_fetch_array($result);
            $address_id = $array['address_id'];
        }else {
            #Get existing address_id
            $array = mysqli_fetch_array($result);
            $address_id = $array['address_id'];
        }

        
        #This code is used to get the new user's customer_id. Used as $_SESSION variable elsewhere
        $sql_id = "SELECT * FROM Customers WHERE email LIKE '".$email."'";
        $result = mysqli_query($db, $sql_id);
        $array = mysqli_fetch_array($result);
        $user_id = $array['customer_id'];
        

        #Inserts address and customer id into linking table
        $sql_address_link = "INSERT INTO Customer_Addresses (customer_id, address_id) VALUES
        ('$user_id','$address_id')";
        mysqli_query($db,$sql_address_link);
    }
}


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
                                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN-10"
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
                        <input type="submit" name="submit" class="btn btn-primary cs-button">
                        <p class="mt-5 mb-3 text-muted">Tecbooks &copy; 2019-2020</p>
                    </form>


                    <!-- Code for managing existing books -->
                    <div class="container-fluid d-none" id="existing_books">
                        <div class="row margin-top">
                            <form class="col-sm center-flex w-50">
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
                            <tbody id="table_body" class="table table-striped">
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>

            <div class="tab-pane fade" id="orders">
                <div class="container-fluid margin-top">
                    <div class="row">
                        <form class="col-sm center-flex">
                            <label for="selectbook" class="sr-only"></label>
                            <select id="selectbook" class="form-control" onChange="display_customer(this.value)">
                                <option value="0">Select Customer</option>
                                <?php
                                        $get_customers = "SELECT * FROM Customers ORDER BY customer_id ASC";
                                        $get_customers_result = mysqli_query($db,$get_customers);
                                        while($get_customers_array = mysqli_fetch_assoc($get_customers_result)) {
                                            echo '<option value='.$get_customers_array['customer_id'].'>ID: '.$get_customers_array['customer_id'].' Name: '.$get_customers_array['firstname'].' '.$get_customers_array['surname'].'</option>';
                                        }
                                    ?>
                            </select>
                        </form>
                    </div>
                    <div id="customers_orders" class="container-fluid margin-top d-none">

                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="admins">
                <div class="container-fluid margin-top">
                    <div class="row">
                        <form class="col-sm center-flex">
                            <label for="selectbook" class="sr-only"></label>
                            <select id="selectbook" class="form-control" onChange="display_admin(this.value)">
                                <option value="0">Select Admin</option>
                                <?php
                                        $get_admins = "SELECT * FROM Customers WHERE user_type = '1' ORDER BY firstname ASC";
                                        $get_admins_result = mysqli_query($db,$get_admins);
                                        while($get_admins_array = mysqli_fetch_assoc($get_admins_result)) {
                                            echo '<option value='.$get_admins_array['customer_id'].'>ID: '.$get_admins_array['customer_id'].' Name: '.$get_admins_array['firstname'].' '.$get_admins_array['surname'].'</option>';
                                        }
                                    ?>
                            </select>
                        </form>
                        <div class="col-sm center-flex">
                            <button class="btn btn-warning" onClick="toggle_new_admin_form()">Add Admin</button>
                        </div>
                    </div>
                    <div id="admin_edited_alert" class="alert alert-success w-50 margin-top d-none" role="alert">
                        Admin Deleted!
                    </div>
                    <div id="existing_admins" class="container-fluid margin-top d-none">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody id="admin_table_body" class="table-striped">
                            </tbody>
                        </table>
                    </div>



                    <!--A form used to register a new admin, calls the PHP at the top of this page -->
                    <div id="new_admin_form" class="container-fluid margin-top d-none">
                        <form action="" method="post">
                            <h1 class="h3 mb-3 font-weight-normal">Register</h1>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstname">First Name</label>
                                    <input class="form-control" id="firstname" type="text" name="firstname" required
                                        autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastname">Last Name</label>
                                    <input class="form-control" type="text" id="lastname" name="lastname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email address</label>
                                <input type="email" id="inputEmail" name="inputEmail" class="form-control"
                                    placeholder="john@email.com" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="inputAddress" name="inputAddress"
                                    placeholder="1234 Main St" required>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Address 2</label>
                                <input type="text" class="form-control" id="inputAddress2" name="inputAddress2"
                                    placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="City">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Edinburgh" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="zip">Postcode/Zip</label>
                                    <input type="text" class="form-control" id="zip" name="zip" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="country">Country</label>
                                    <select type="text" class="form-control" id="country" name="country" required>
                                        <option value="United Kingdom">United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" id="password" name="password"
                                        placeholder="Password" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="repeatpassword">Repeat Password</label>
                                    <input class="form-control" type="password" id="repeatpassword"
                                        name="repeatpassword" placeholder="Repeat Password" required>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit_admin">Register
                                Admin</button>
                            <p class="mt-5 mb-3 text-muted">Tecbooks &copy; 2019-2020</p>
                        </form>
                    </div>
                </div>
                <script src="./js/admin.js"></script>
                <?php include("./inc/generic_footer.php");?>
</body>

</html>