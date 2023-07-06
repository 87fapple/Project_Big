<?php
// $str = file_get_contents('data.txt');
// echo $str;

// file_put_contents('data.txt', 'zzxcv');

// if (! file_exists('documents')){
//     mkdir('documents');
// }

// file_put_contents('documents/bbb.txt', 'hi');
// unlink('documents/bbb.txt');

// $str = date('Y/n/d H:i:s');
// echo $str;

// $d = date_create('2023/6/21 8:9:1');
// $epoch = date_format($d, 'U');
// $arr = getdate($epoch);

// echo '<pre>';
// print_r($arr);
// echo '</pre>';

require('DB.php');
DB::select("select * from bill where tel='2222' limit 1",function($rows){
    $d = date_create($rows[0]['dd']);
    $epoch = date_format($d, 'U');
    $arr = getdate($epoch);

    echo '<pre>';
    print_r($arr);
    echo '</pre>';

    echo $arr['year'];
});
?>