<?php
require("db.php");

$uid = $_REQUEST['uid'];
$pwd = $_REQUEST['pwd'];

$sql = "select * from userinfo where uid = '$uid' and pwd = '$pwd'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

var_dump($row['pwd']);
?>