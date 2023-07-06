<?php session_start(); ?>
<?php
if (!$_COOKIE["token"]) {
    header("location: login_F.php");
    die();
}

$arr = ['e_cname', 'e_pwd'];
for ($x = 0; $x < count($arr); $x++) {
    if (!isset($_REQUEST["{$arr[$x]}"]) || trim($_REQUEST["{$arr[$x]}"] === "")) {
        echo "資料不可為空,或者有誤";
        header("refresh:3;url=edit.php");
    }
}

require_once('DB.php');
require_once('user.php');

$cname = $_REQUEST["e_cname"];
$pwd = $_REQUEST["e_pwd"];
$src = $_FILES['file']['tmp_name'];
$contents = file_get_contents($src);

$user = unserialize($_SESSION['user']);
$user->edituser($cname, $pwd, $contents);
unlink($src);

// $sql = "update userinfo set cname= ?, pwd= ?, image = ? where token = ?";
// $stmt = $mysqli->prepare($sql);
// $stmt->bind_param('ssbs', $cname, $pwd, $contents, $token);
// $stmt->send_long_data(2, $contents);
// $stmt->execute();
// unlink($src);
?>