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

// require('db.php');

// $token = $_COOKIE["token"];
// $cname = $_REQUEST["e_cname"];
// $pwd = $_REQUEST["e_pwd"];
// $src = $_FILES['file']['tmp_name'];
// $contents = file_get_contents($src);

// $sql = "update userinfo set cname= ?, pwd= ?, image = ? where token = ?";
// $stmt = $mysqli->prepare($sql);
// $stmt->bind_param('ssbs', $cname, $pwd, $contents, $token);
// $stmt->send_long_data(2, $contents);
// $stmt->execute();
// unlink($src);

// echo "修改成功! 三秒後自動跳轉";
// header("refresh:3;url=welcome.php");
?>