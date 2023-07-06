<?php
require('db.php');

$uid = $_REQUEST['uid'];

$sql = "select image from userinfo where uid = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $uid);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    $image = $row['image'];
}


// 找不到大頭照 使用預設大頭照
if ($image == null){
    $image = file_get_contents('https://cdn0.techbang.com/system/excerpt_images/8428/original/de636579295c2d745894c8daf8af51ae.jpg?1329274269');
}
header('content-type: image/jpeg');
echo $image;