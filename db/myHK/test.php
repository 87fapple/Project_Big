<?php
require('./db/db.php');

$uid = $_REQUEST['uid'];
$pwd = $_REQUEST['pwd'];

if (isset($uid) && trim($uid) !== "") {
    $sql = "select uid from userinfo where uid = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if (isset($row['uid'])) {
        echo "x 已存在此uid";
    } else {
        echo "v 可以使用";
    }
}else{
    echo "不能為空";
}



