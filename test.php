<?php

$pass1 = "1234";
$pass2 = '1234';

$hs1 = password_hash($pass1, PASSWORD_BCRYPT);
$hs2 = password_hash($pass2, PASSWORD_BCRYPT);

echo password_verify($pass2, $hs1);