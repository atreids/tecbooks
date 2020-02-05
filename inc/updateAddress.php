<?php 
session_start();
include("./connection.php");

echo '

<form action="./updateCustAddress.php" method="post">

<label>Building Number</label>
<input type="text" name="buildingnum" placeholder="Number">
<label>Street Name</label>
<input type="text" name="street" placeholder="Street">
<label>City</label>
<input type="text" name="city" placeholder="City">
<label>Zip/Post Code</label>
<input type="text" name="zip_postcode" placeholder="Zip/Post Code">
<label>Country</label>
<input type="text" name="country" placeholder="Country">
<input type="submit" name="submit">
</form>


';

?>