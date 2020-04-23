<?php
session_start();
include("./connection.php");
$id = $_SESSION['user_id'];
$sql = "SELECT building_number, street_name, city, zip_postcode, iso_country_code FROM addresses 
JOIN customer_addresses ON addresses.address_id = customer_addresses.address_id JOIN customers ON customer_addresses.customer_id = customers.customer_id";
$result = mysqli_query($db,$sql);

echo '
<div class="row center-text">
<div class="col-sm-6">
<form class="form-signin" action="javascript:addAddress()" method="post">
    <input class="form-control" type="text" id="num" placeholder="Building Number"><br>
    <input class="form-control" type="text" id="street" placeholder="Street Name"><br>
    <input class="form-control" type="text" id="city" placeholder="City"><br>
    <input class="form-control" type="text" id="zip" placeholder="Zip"><br>
    <input class="form-control" type="text" id="iso" placeholder="ISO"><br>
    <select id="add_type">
        <option value="DEL">Delivery</option>
        <option value="BILL">Billing</option>
    </select> <br>
    <input class="btn btn-blue" type="submit" name="submit"><br>
</form>
</div>
';
while($row = mysqli_fetch_assoc($result)){
    echo '
    
    <div class="col-sm-6">
    <div class="addresses panel">
    <p class="address-p">'.$row['building_number'].'</p>
    <p class="address-p">'.$row['street_name'].'</p>
    <p class="address-p">'.$row['city'].'</p>
    <p class="address-p">'.$row['zip_postcode'].'</p>
    <p class="address-p">'.$row['iso_country_code'].'</p>
    </div>
    </div>
    </div>
    ';
    
    }
    
?>