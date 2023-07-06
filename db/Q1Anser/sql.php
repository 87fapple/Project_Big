<?php
require('db.php');


$uid = $_REQUEST['uid'];
$nullDefault = '無';

$sql = "
select UserInfo.uid, ifnull(cname, '無') as cname, ifnull(address, '無') as address, ifnull(tel, '無') as tel
from UserInfo left join Live
   on UserInfo.uid  = Live.uid
   left join House
   on live.hid = House.hid
   left join phone
   on Phone.hid = House.hid
where UserInfo.uid = '{$uid}'
";

// 後端不要夾帶變數>會有資安問題
$sql_v2 = "call queryUserInfo(?, 'none');";
$sql_v3 = "call queryUserInfo(?, ?);"; // 多問號寫法

$stmt = $mysqli->prepare($sql_v2); // statement
$stmt->bind_param('s', $uid);
// $stmt->bind_param('ss', $uid, $nullDefault); // 多問號寫法差異
$stmt->execute();
$result = $stmt->get_result();

// $result = $mysqli->query($sql_v2);
while($row = $result->fetch_assoc()) {
   echo "{$row['cname']},{$row['address']},{$row['tel']}\n";
}
