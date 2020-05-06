<!--
Developed by Aaron Donaldson.
For educational purposes.
contact at ec1823622@edinburghcollege.ac.uk

This is the user's account page, allows them to manage their account
-->

<?php
session_start();
require("./php/connection.php");

#This code processes when new address form is submitted
if(isset($_POST['submit_address'])) {

    
    #Variables entered by user
    $user_id = $_SESSION['user_id'];
    $address1 = $_POST['inputAddress'];
    $address2 = $_POST['inputAddress2'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zip = $_POST['zip'];
    
    
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
    
    
    #Inserts address and customer id into linking table
    $sql_address_link = "INSERT INTO Customer_Addresses (customer_id, address_id) VALUES
    ('$user_id','$address_id')";
    mysqli_query($db,$sql_address_link);
}

#This code processes when edit address form is submitted.
#Doesn't actually edit the existing address, instead it cuts the link between the customer and that address
#and then makes a new address for the customer. This is just incase two customers live at the same address and one of them moves
if(isset($_POST['submit_edit_address'])) {

    
    #Variables entered by user
    $customer_id = $_SESSION['user_id'];
    $address_id = $_POST['address_id'];
    $address1 = $_POST['inputAddress'];
    $address2 = $_POST['inputAddress2'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zip = $_POST['zip'];


    #Deletes Link
    $delete_address ="DELETE FROM Customer_Addresses WHERE Customer_Addresses.customer_id = ".$customer_id." AND Customer_Addresses.address_id = ".$address_id."";
    if(!mysqli_query($db,$delete_address)) { 
        die ('Error: ' .mysqli_error($db));
    };

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
        $new_address_id = $array['address_id'];
    }else {
        #Get existing address_id
        $array = mysqli_fetch_array($result);
        $new_address_id = $array['address_id'];
    }
    
    
    #Inserts address and customer id into linking table
    $sql_address_link = "INSERT INTO Customer_Addresses (customer_id, address_id) VALUES
    ('$customer_id','$new_address_id')";
    mysqli_query($db,$sql_address_link);
    
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- includes necessary meta tags and other data -->
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks | <?php echo $_SESSION['fname']; ?></title>
</head>

<body class="d-flex flex-column">

    <!-- Includes the navbar -->
    <?php include("./inc/nav.php");?>


    <div class="container-fluid divider"></div>


    <div class="container margin-top">

        <!-- tabs seperating account management into different sections-->
        <ul class="nav nav-tabs nav-fill">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#details">Your
                    Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#addresses">Your Addresses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#history">Purchase History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#reviews">Reviews</a>
            </li>
        </ul>

        <!-- contains the different tabs contents, only the content of the currently selected tab is visible to the user -->
        <div class="tab-content">

            <!-- contents for the user managing general account details like email, changing password or deleting their account -->
            <div class="tab-pane fade show active" id="details">


                <?php
                    #Php to get the users details from the database
                    $sql = "SELECT * FROM Customers WHERE customer_id = ".$_SESSION['user_id']."";
                    if(!mysqli_query($db,$sql)) {
                        die ('Error: ' .mysqli_error($db));
                    }else{
                        $result = mysqli_query($db,$sql);
                        $array = mysqli_fetch_array($result);
                        $firstname = $array['firstname'];
                        $lastname = $array['surname'];
                        $email = $array['email'];
                    }
                ?>


                <h3 class="margin-top">Your Details:</h3>

                <!--generic information -->
                <p>Name: <?php echo $firstname." ".$lastname;?></p>
                <p>Email: <?php echo $email ?></p>

                <!-- buttons to perform different actions, all js is on account.js page -->
                <button class="btn btn-primary btn-sm" onClick="display_change_email_form()">Change Email</button>
                <button class="btn btn-warning btn-sm" onClick="change_password_form()">Change Password</button>
                <button class="btn btn-danger btn-sm" onClick="display_delete_account()">Delete Account</button>

                <!--alert is populated with ajax response data depending on what action was performed, normally not visible -->
                <div id="details_alert" class="alert alert-warning w-25 margin-top d-none" role="alert">
                </div>

                <!-- form to change the user's password, js is on account.js page -->
                <div id="change_password_form" class="margin-top d-none">
                    <div class="form-group w-25">
                        <label for="current_password" class="sr-only">Input Current Password</label>
                        <input type="password" id="current_password" name="current_password" class="form-control"
                            placeholder="Current Password" required autofocus>
                    </div>
                    <div class="form-group w-25">
                        <label for="new_password" class="sr-only">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-control"
                            placeholder="New Password" required>
                        <label for="repeat_new_password" class="sr-only">Repeat New Password</label>
                        <input type="password" id="repeat_new_password" name="repeat_new_password"
                            class="form-control margin-top" placeholder="Repeat New Password" required>
                        <button class="btn btn-warning btn-sm margin-top" onClick="change_password()">Change
                            Password</button>
                    </div>
                </div>

                <!-- confirmation form for deleting the account and also calls the delete_account js function in account.js -->
                <div id="delete_account" class="margin-top d-none">
                    <div class="form-group w-25">
                        <label for="current_password2">Enter current password to delete account</label>
                        <input type="password" id="current_password2" name="current_password2" class="form-control"
                            required>
                    </div>
                    <div class="form-group w-25 margin-top">
                        <button class="btn btn-danger" onClick="delete_account()">DELETE</button>
                    </div>
                </div>

                <!--form for changing the user's email address, again calls account.js function -->
                <div id="change_email_form" class="margin-top d-none">
                    <div class="form-row">
                        <div class="form-group w-25">
                            <label for="change_email" class="sr-only">New Email:</label>
                            <input type="email" id="change_email" name="change_email" class="form-control"
                                placeholder="New Email" required>
                        </div>
                        <div class="form-group w-25 ml-1">
                            <button class="btn btn-primary" onClick="change_email()">Submit</button>
                        </div>
                    </div>
                </div>

                <!--alert specific to when the email is successfully updated, normally not visible -->
                <div id="email_updated_alert" class="alert alert-success w-25 margin-top d-none" role="alert">
                    Email Updated!
                </div>




                <!--cute message from dr. seuss-->
                <div class="container margin-top-lg margin-bottom">
                    <div class="row">
                        <div class="col-sm center-flex flex-column">
                            <h2><em>“The more that you read, the more things you will know. The more that you
                                    learn, the
                                    more
                                    places
                                    you’ll go.”</em> – Dr. Seuss</h2>
                            <p>Want to get even more reading in? Next time you are in store, talk to us about
                                signing up
                                to our
                                monthly newsletter.
                                <br>You'll receive all sorts of news on upcoming deals!</p>
                        </div>
                        <div class="col-sm">
                            <img src="./img/bookshelves.jpg" class="circle vsm-img">
                        </div>
                    </div>
                </div>


            </div>

            <!-- content for user managing their addresses linked to their account -->
            <div class="tab-pane fade" id="addresses">

                <!-- buttons to view their existing addresses or to add a new one -->
                <!-- js calls are to account.js -->
                <div class="container-fluid margin-top">
                    <div class="row">
                        <div class="col-sm center-flex">
                            <button class="btn btn-warning" onClick="display_current_addresses()">View
                                Addresses</button>
                        </div>
                        <div class="col-sm center-flex">
                            <button class="btn btn-warning" onClick="display_new_address_form()">Add
                                Address</button>
                        </div>
                    </div>
                </div>


                <?php
                #code outputs exisiting addresses in some nicely formatted cards, displayed when the display_current_address() js function is called in account.js
                    $sql = "SELECT * FROM Addresses JOIN Customer_Addresses ON Addresses.address_id = Customer_Addresses.address_id
                    JOIN Customers ON Customer_Addresses.customer_id = Customers.customer_id WHERE Customers.customer_id = ".$_SESSION['user_id']."";
                    if(!mysqli_query($db,$sql)) {
                        die ('Error: ' .mysqli_error($db));
                    }else{
                        $result = mysqli_query($db,$sql);
                        
                    }
                    if(mysqli_num_rows($result) < 1) {
                        #displays an alert that the user doesn't have any registered addresses
                        echo '
                            <div class="alert alert-warning w-50 margin-top">
                                This User Has No Addresses
                            </div>
                        ';
                    }else{
                    echo '<div class="container-fluid margin-top d-none flex-row flex-wrap" id="current_addresses">';
                    while($address_array = mysqli_fetch_array($result)){
                        echo '
                            <div class="card margin-top ml-1 mr-1" style="width:20rem;" id="'.$address_array['address_id'].'">
                                <div class="card-header">
                                    Address
                                </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    '.$address_array['address1'].'
                                </li>';
                        if(isset($address_array['address2']) and !empty($address_array['address2'])) {
                            echo '
                                <li class="list-group-item">
                                    '.$address_array['address2'].' 
                                </li>
                                ';
                                }; 
                            echo '
                                <li class="list-group-item">
                                    '.$address_array['zip_postcode'].'
                                </li>
                                <li class="list-group-item">
                                    '.$address_array['city'].'
                                </li>
                                <li class="list-group-item">
                                    '.$address_array['country'].'
                                </li>
                            </ul>
                            <div class="card-body">
                                <button class="btn btn-warning margin-top" onClick="display_change_address_form('.$address_array['address_id'].')">Change
                                Address</button>
                                <button class="btn btn-danger margin-top" onClick="delete_address('.$_SESSION['user_id'].','.$address_array['address_id'].')">
                                Remove Address</button>
                            </div>
                            </div>
                            ';
                    };
                    echo '</div>';
                };
                ?>


                <!--form to edit an existing address, calls js function in account.js -->

                <div class="container-fluid margin-top d-none" id="edit_form">
                    <form action="" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">Edit Address</h1>
                        <div class="form-group">
                            <input type="hidden" name="address_id" id="address_id" value="">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" name="inputAddress"
                                placeholder="1234 Main St" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2" name="inputAddress2"
                                placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="City">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Edinburgh"
                                    required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="zip">Postcode/Zip</label>
                                <input type="text" class="form-control" id="zip" name="zip" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="country">Country</label>
                                <select type="text" class="form-control" id="country" name="country" required>
                                    <option value="" selected="selected">Select Country</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean
                                        Territory
                                    </option>
                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic
                                        Republic
                                        of The
                                    </option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)
                                    </option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Territories">French Southern Territories
                                    </option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald
                                        Islands
                                    </option>
                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)
                                    </option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea, Democratic People's Republic of">Korea, Democratic
                                        People's
                                        Republic of
                                    </option>
                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Lao People's Democratic Republic">Lao People's Democratic
                                        Republic
                                    </option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="North Macedonia">North Macedonia</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia, Federated States of">Micronesia, Federated States
                                        of
                                    </option>
                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory, Occupied">Palestinian Territory,
                                        Occupied
                                    </option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russian Federation</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Helena">Saint Helena</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The
                                        Grenadines
                                    </option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia and The South Sandwich Islands">South Georgia
                                        and The
                                        South
                                        Sandwich Islands</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of
                                    </option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-leste">Timor-leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">United States Minor
                                        Outlying
                                        Islands
                                    </option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viet Nam">Viet Nam</option>
                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>

                                </select>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit_edit_address">Edit
                            Address</button>
                    </form>
                </div>


                <!-- Form to add a new address, calls js function in account.js-->
                <div class="container-fluid margin-top d-none" id="new_address_form">
                    <form action="" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">Add Address</h1>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" name="inputAddress"
                                placeholder="1234 Main St" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2" name="inputAddress2"
                                placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="City">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Edinburgh"
                                    required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="zip">Postcode/Zip</label>
                                <input type="text" class="form-control" id="zip" name="zip" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="country">Country</label>
                                <select type="text" class="form-control" id="country" name="country" required>
                                    <option value="" selected="selected">Select Country</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean
                                        Territory
                                    </option>
                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic
                                        Republic
                                        of The
                                    </option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)
                                    </option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Territories">French Southern Territories
                                    </option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald
                                        Islands
                                    </option>
                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)
                                    </option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea, Democratic People's Republic of">Korea, Democratic
                                        People's
                                        Republic of
                                    </option>
                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Lao People's Democratic Republic">Lao People's Democratic
                                        Republic
                                    </option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="North Macedonia">North Macedonia</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia, Federated States of">Micronesia, Federated States
                                        of
                                    </option>
                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory, Occupied">Palestinian Territory,
                                        Occupied
                                    </option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russian Federation</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Helena">Saint Helena</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The
                                        Grenadines
                                    </option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia and The South Sandwich Islands">South Georgia
                                        and The
                                        South
                                        Sandwich Islands</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of
                                    </option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-leste">Timor-leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">United States Minor
                                        Outlying
                                        Islands
                                    </option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viet Nam">Viet Nam</option>
                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>

                                </select>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit_address">Submit
                            Address</button>
                    </form>
                </div>
            </div>

            <!--contents for user to view their order history -->
            <div class="tab-pane fade" id="history">
                <?php
                #Displays customers orders in some nicely formatted cards
                $customers_orders = "SELECT order_id, date_order_placed, order_total, order_status FROM Customers_Orders JOIN Customers ON 
                Customers_Orders.customer_id=Customers.customer_id WHERE Customers.customer_id = ".$_SESSION['user_id']." ORDER BY order_id DESC";
                $orderid_result = mysqli_query($db, $customers_orders);

                #Loop to display multiple cards, one for each order
                #Has a loop inside it because of order data and book data being so far apart 
                while($orderid_array = mysqli_fetch_array($orderid_result)){
                    echo '
                    <div class="card margin-top">
                    <div class="card-header">
                        Order ID: '.$orderid_array['order_id'].'<br>
                        Date: '.$orderid_array['date_order_placed'].'
                    </div>
                    <ul class="list-group list-group-flush">
                    ';
                    #Gets the individual book details and their quantity on the order
                    $sql_orderdata = "SELECT * FROM Books JOIN Customer_Orders_Books ON Books.stock_id = Customer_Orders_Books.stock_id
                    JOIN Customers_Orders ON Customer_Orders_Books.order_id = Customers_Orders.order_id JOIN Customers ON 
                    Customers_Orders.customer_id=Customers.customer_id WHERE Customers.customer_id = ".$_SESSION['user_id']." AND Customers_Orders.order_id = ".$orderid_array['order_id']."";
                    $orderdata_result = mysqli_query($db, $sql_orderdata);
                    while($data_array = mysqli_fetch_assoc($orderdata_result)){
                        echo '<li class="list-group-item">
                                <b>Title:</b> '.$data_array['title'].'<br>
                                <b>Author:</b> '.$data_array['author'].'<br>
                                <b>Quantity:</b> x'.$data_array['quantity'].'<br>
                                <b>Price:</b> £'.$data_array['price'].'<br>
                                </li>';
                    }
                    echo '
                    </ul>
                    <div class="card-footer">
                        Total: £'.$orderid_array['order_total'].'<br>
                        Order Status: ';
                            if($orderid_array['order_status'] == '0') {
                                echo 'Processing';
                            }elseif($orderid_array['order_status'] == '1') {
                                echo 'Out For Delivery';
                            }else {
                                echo 'Delivered';
                            }
                    echo '
                    </div>
                    </div>
                    ';
                }
                ?>

                <!--displays a cute helpful message to the user -->
                <div class="card margin-top">
                    <div class=" card-header">
                        Have a problem with an order?
                    </div>
                    <div class="card-body">
                        We'd like to think that every order can go off without a hitch!<br>
                        However, we know that sometimes things happen in life that we don't plan for.<br>
                        So if you have any problems at all with your order, feel free to<br>
                        <a href="./contact.php" class="btn btn-primary margin-top">Contact Us!</a>
                    </div>
                </div>

            </div>

            <!--contents for user to view and manage their reviews -->
            <div class="tab-pane fade" id="reviews">

                <!-- alert for successfully deleting a review, is normally not visible -->
                <div id="review_deleted_alert" class="alert alert-success w50 d-none">Review Deleted</div>

                <!-- container containing reviews -->
                <div class="container-fluid d-flex flex-wrap">

                    <?php
                    #php code displays user's reviews in some nicely formatted cards
                    #delete button calls js function in account.js called delete_review with the reviews unique id
                $reviews_sql = "SELECT * FROM Reviews JOIN Customers ON Reviews.customer_id = Customers.customer_id JOIN Books ON Reviews.stock_id = Books.stock_id WHERE Customers.customer_id = ".$_SESSION['user_id'].""; 
                $reviews_result = mysqli_query($db, $reviews_sql);
                if(mysqli_num_rows($reviews_result) < 1){
                    echo ' 
                        <div class="alert alert-warning w50 margin-top" role="alert">
                            You\'ve not left any reviews yet!
                        </div>
                    ';
                }else {
                    while($reviews_array = mysqli_fetch_assoc($reviews_result)) {
                        echo '
                        <div class="card mr-1 margin-top" style="width:20rem">
                            <div class="card-header">Review of: '.$reviews_array['title'].'</div>
                            <div class="card-body">
                                <p class="card-text">'.$reviews_array['review_text'].'</p>
                            </div>
                            <div class="card-footer">
                                <p class="card-text">Number of Stars: '.$reviews_array['stars'].'</p>
                                <button class="btn btn-sm btn-danger" onclick="delete_review('.$reviews_array['review_id'].')">Delete</button>
                            </div>
                        </div>
                    
                        ';
                    
                    }
                }

            ?>
                </div>
            </div>
        </div>
    </div>

    <!-- very important script file that manages almost every action on the account page -->
    <script src="./js/account.js"></script>

    <!-- Some needed <script></script> tags, mainly for bootstrap stuff -->
    <?php include("./inc/generic_footer.php");?>
</body>

</html>