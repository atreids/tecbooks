<?php 

namespace Listener;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('PaypalIPN.php');
use PaypalIPN;

$ipn = new PaypalIPN();
session_start();
// Use the sandbox endpoint during testing.
$ipn->useSandbox();
$verified = $ipn->verifyIPN();
if ($verified) {
    $handle = fopen("test.txt", "w");
    foreach ($_POST as $key => $value)
        fwrite($handle, "$key => $value \r\n");
    fclose($handle);
    /*
     * Process IPN
     * A list of variables is available here:
     * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
     */
    $cost = $_POST['mc_gross'];
    require("./php/connection.php");
    $sql = "INSERT INTO test VALUES ('.$cost.')";
    if(!mysqli_query($db,$sql)) {
        die ('Error: ' .mysqli_error($db));
    }
}
$handle = fopen("test2.txt", "w");
    foreach ($_POST as $key => $value)
        fwrite($handle, "$key => $value \r\n");
    fclose($handle);

// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");

?>