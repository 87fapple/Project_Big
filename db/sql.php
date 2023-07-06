<?php
require('db.php');

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$arr = [];
$i = 0;

$sql ="
SELECT cname, address, p.tel as tel
FROM
	userinfo u LEFT JOIN live l
    ON l.uid = u.uid
   	LEFT JOIN backup_house bh
    on bh.hid = l.hid
    LEFT JOIN phone p
    on bh.hid = p.hid
WHERE
	u.uid = '$username' AND u.pwd = '$password';
";

$sql2 = "select * from live";

$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()){
    $arr['cname'][$i] = "{$row['cname']}";
    $arr['address'][$i] = "{$row['address']}";
    $arr['tel'][$i] = "{$row['tel']}";
    $i ++;
    // echo "{$row['cname']}, {$row['address']}, {$row['tel']}<br>";
}


// var_dump($arr);

echo json_encode($arr, JSON_UNESCAPED_UNICODE);

// while ($row = $result->fetch_assoc()){
//     echo "{$row['uid']}, {$row['cname']} <br>";
// }

//姓名 住址 電話 放在三個標籤(label)