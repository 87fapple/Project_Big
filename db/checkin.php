<?php session_start(); ?>
<?php
if (isset($_COOKIE["token"])) {
    header("location: welcome.html");
}

require('db.php');

$uid = $_REQUEST['uid'];
$pwd = $_REQUEST['pwd'];

$sql = "call login(?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ss', $uid, $pwd);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// eema攻擊
// $sql = "select * from userinfo where uid = '$uid' and pwd = '$pwd'";
// $result = $mysqli->query($sql);
// $row = $result->fetch_assoc();
// if ($row == null) {
//     header("location: no error.html");
// }else{
//     header("location: welcome.html");
// }

$nextPage = $row['result'];
$token = $row['token'];

if ($nextPage == 'welcome.php') {
    // $_SESSION["uid"] = $uid;
    // $_SESSION["welcome"] = $nextPage;
    setcookie('token', $token, time() + 120);
    setcookie('welcome', $nextPage, time() + 120);
}
header("location: {$nextPage}");