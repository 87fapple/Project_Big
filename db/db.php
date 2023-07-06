<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pwd  = "";
$db   = "AddressBook";

$mysqli = new mysqli($host, $user, $pwd, $db);
?>