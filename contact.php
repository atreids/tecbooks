<?php
session_start();
require("./php/connection.php");
?>

<!doctype html>
<html lang="en">

<head>
    <?php include("./inc/generic_header.php");?>

    <title>Tecbooks</title>
</head>

<body>
    <?php include("./inc/nav.php");?>
    <div class="container margin-top-lg">
        <h2>Contact Us</h2>
        <div class="row">
            <div class="col-sm">
                <em>Our Address:</em><br>
                1234 Scotland Row<br>
                EH7 1HF<br>
                Edinburgh<br>
                United Kingdom<br><br>
                Or by email:<br>
                ec1823622@edinburghcollege.ac.uk
            </div>
            <div class="col-sm">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4467.820548444106!2d-3.2091216013093873!3d55.950927048179025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4887c78e350fe40d%3A0x92b9be88ee93efc5!2sWaterstones!5e0!3m2!1sen!2suk!4v1588286002366!5m2!1sen!2suk"
                    width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0">
                </iframe>
            </div>
        </div>
    </div>

    <?php include("./inc/generic_footer.php");?>
</body>

</html>