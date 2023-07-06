<?php
require('db.php');

$uid = $_REQUEST['uid'];
$src = $_FILES['file']['tmp_name'];
$contents = file_get_contents($src);

$sql = "update userinfo set image = ? where uid = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('bs', $contents, $uid);
$stmt->send_long_data(0, $contents); // send_long_data(a, 變數) a取至於上方的相對位置 (bs) [01]
$stmt->execute();

echo "修改成功!";
sleep(5);

unlink($src);

// $src = $_FILES['file']['tmp_name'];
// $dst = './images/' . $_FILES['file']['name']; // 相對路徑
// $dst = $_SERVER['DOCUMENT_ROOT'] . './images/' . $_FILES['file']['name']; // 絕對路徑

// if (move_uploaded_file($src, $dst)) {
//     echo 'success';
// } else {
//     echo 'ERROR:' . $_FILES['file']['error'];
// }
?>