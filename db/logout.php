<?php session_start(); ?>
<?php
unset($_SESSION["uid"]);
setcookie("token", '', -1);
setcookie("welcome", '', -1);

require('db.php');

$sql = "call logout(?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $_COOKIE['token']);
$stmt->execute();

header("location: login_F.php");
?>