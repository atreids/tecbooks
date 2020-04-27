<?php 
session_start();
include("./connection.php");
$user_id = $_SESSION['user_id'];
$num = $_POST['num'];
$street = $_POST['street'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$iso = $_POST['iso'];
$add_type = $_POST['add_type'];
$sql = "INSERT INTO Addresses (building_number,street_name,city,zip_postcode,iso_country_code)
VALUES ('".$num."','".$street."','".$city."','".$zip."','".$iso."')";

if(!mysqli_query($db,$sql)) {
    die ('Error: ' .mysqli_error($db));
} else {
    $sql = "SELECT address_id FROM Addresses ORDER BY address_id DESC LIMIT 1";
    $result = mysqli_query($db,$sql);
    $id = mysqli_fetch_assoc($result);
    $sql = "INSERT INTO customer_addresses VALUES ('".$user_id."','".$id['address_id']."','".$add_type."')";
    if(!mysqli_query($db,$sql)) {
        die ('Error: ' .mysqli_error($db));
    } else {
        $query = "SELECT building_number, street_name, city, zip_postcode, iso_country_code FROM Addresses 
        JOIN customer_addresses ON Addresses.address_id = customer_addresses.address_id JOIN customers ON customer_addresses.customer_id = customers.customer_id";
        $result = mysqli_query($db,$query);
        while($row = mysqli_fetch_assoc($result)){
        echo '
        <div class="card addresses">
            <p class="address-p">'.$row['building_number'].'</p>
            <p class="address-p">'.$row['street_name'].'</p>
            <p class="address-p">'.$row['city'].'</p>
            <p class="address-p">'.$row['zip_postcode'].'</p>
            <p class="address-p">'.$row['iso_country_code'].'</p>
        </div>
        ';
    }
}
    echo '
        <form class="address-form" action="javascript:addAddress()" method="post">
        <input type="text" id="num" placeholder="Building Number"><br>
        <input type="text" id="street" placeholder="Street Name"><br>
        <input type="text" id="city" placeholder="City"><br>
        <input type="text" id="zip" placeholder="Zip"><br>
        <input type="text" id="iso" placeholder="ISO"><br>
        <select id="add_type">
            <option value="DEL">Delivery</option>
            <option value="BILL">Billing</option>
        </select> <br>
        <input class="btn" type="submit" name="submit"><br>
        </form>
';
}
mysqli_close($db);
?>