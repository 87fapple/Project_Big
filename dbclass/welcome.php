<?php session_start(); ?>
<?php
require_once('DB.php');
require_once('user.php');

if (!$_COOKIE["token"]) {
    header("location: login_F.php");
    die();
}

$user = unserialize($_SESSION['user']);
// $user->getInfo();

// die($user->css_width);
/*
$token = $_COOKIE["token"];
$cname = null;
$image = null;
$src = null;

DB::select('select * from userinfo where token = ?', function($rows) {
    global $cname, $image, $src;
    $cname = $rows[0]['cname'];
    $image = $rows[0]['image'];
    if ($image == null) {
        $image = file_get_contents('https://cdn0.techbang.com/system/excerpt_images/8428/original/de636579295c2d745894c8daf8af51ae.jpg?1329274269');
    }
    $mine_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($image);
    $image_base64 = base64_encode($image);
    $src = "data:{$mine_type};base64,{$image_base64}";
}, [$token]);
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    </style>
</head>

<body>
    <div><button onclick="location.href = 'edit.php'">編輯</button></div>
    <h1><?= $user->cname; ?> welcome!</h1>
    <img src="<?= $user->src; ?>">
    <a href="logout.php">登出</a>
</body>

</html>