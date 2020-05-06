<!--
Developed by Aaron Donaldson.
For educational purposes.
contact at ec1823622@edinburghcollege.ac.uk

This is the registration page
-->

<?php
require("./php/connection.php"); #Connects to database, $db is connection call
require("./php/password.php"); #Required for BCRYPT hashing algorithm to function on PHP 5.3.10, is not needed past PHP 5.5

#Starting a session is used both if they successfully register and to check that they aren't already logged in
session_start();


if(isset($_SESSION['login'])){ #Redirects if already logged in
    header("location: ./index.php");
}


#This code processes when registration form is submitted
if(isset($_POST['submit'])) {

    
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
        header("location: ./register.php?pm=1"); #Returns with error that passwords do not match
    }else {

        #Insert customers data into database
        $sql = "INSERT INTO Customers (firstname, surname, hashed_pass, email, user_type) VALUES
        ('$fname','$lname','$pass','$email','0')";
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
            #Or get existing address_id
            $array = mysqli_fetch_array($result);
            $address_id = $array['address_id'];
        }

        
        #This code is used to get the new user's customer_id. Used as $_SESSION['user_id] variable elsewhere
        $sql_id = "SELECT * FROM Customers WHERE email LIKE '".$email."'";
        $result = mysqli_query($db, $sql_id);
        $array = mysqli_fetch_array($result);
        $user_id = $array['customer_id'];
        

        #Inserts address and customer id into linking table
        $sql_address_link = "INSERT INTO Customer_Addresses (customer_id, address_id) VALUES
        ('$user_id','$address_id')";
        mysqli_query($db,$sql_address_link);

        #Declares some $_SESSION data so user is automatically logged in
        #user_id is customer_id, login is used both to check logged in status and admin status
        #user_name is the customers first name
        $_SESSION['user_id'] = $user_id;
        $_SESSION['login'] = 'nonadmin'; #Can either be nonadmin or admin
        $_SESSION['user_name'] = $fname;
        header("location: ./index.php"); #redirects to homepage now that registration is complete
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Generic header contains meta data and styling -->
    <?php include("./inc/generic_header.php");?>

    <title>Register</title>
</head>

<body>
    <!-- nav.php contains navbar-->
    <?php include("./inc/nav.php");?>
    <!-- small dividing bar below navbar -->
    <div class="container-fluid divider"></div>
    <!-- Registration form -->
    <div class="container margin-top-lg">
        <form action="" method="post">
            <h1 class="h3 mb-3 font-weight-normal">Register</h1>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">First Name</label>
                    <input class="form-control" id="firstname" type="text" name="firstname" required autofocus>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Last Name</label>
                    <input class="form-control" type="text" id="lastname" name="lastname" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="john@email.com"
                    required>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="1234 Main St"
                    required>
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" name="inputAddress2"
                    placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="City">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Edinburgh" required>
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
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
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
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The
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
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
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
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
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
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of
                        </option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
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
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
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
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
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
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
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
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South
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
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
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
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands
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
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" placeholder="Password"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <label for="repeatpassword">Repeat Password</label>
                    <input class="form-control" type="password" id="repeatpassword" name="repeatpassword"
                        placeholder="Repeat Password" required>
                </div>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button>
            <p class="mt-5 mb-3 text-muted">Tecbooks &copy; 2019-2020</p>
        </form>

        <!-- this php responds to if the user's registeration fails, with a small error message -->
        <?php
            if(isset($_GET['uex'])) {
                echo '
                    <div class="alert alert-danger" role="alert">
                        Email already registered!
                    </div>
                    ';
            }
            if(isset($_GET['pm'])) {
                echo '
                    <div class="alert alert-danger" role="alert">
                        Passwords do not match!
                    </div>
                    ';
            }
        ?>


    </div>
    <!-- Generic footer contains some <script> tags used on all pages -->
    <?php include("./inc/generic_footer.php");?>
</body>

</html>