<?php
require('DB.php');
// DB::select('select * from userinfo where uid = ? or uid = ?', function($rows) {
//     foreach($rows as $row) {
//         echo "{$row['cname']}<br>";
//     }
// }, ['A01','A02', 10]);

$photo = file_get_contents('tttt.jpg');

DB::update('update userinfo set image = ? where uid = ?', [[$photo], 'A01']);
?>