<?php session_start(); ?>
<?php
if (! $_COOKIE["token"] ) {
    header("location: login_F.php");
    die();
}

require('db.php');
$token = $_COOKIE["token"];
$sql = 'select * from userinfo where token = ?';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $token);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$cname = $row['cname'];
$image = $row['image'];
if ($image == null) {
    $image = file_get_contents('https://cdn0.techbang.com/system/excerpt_images/8428/original/de636579295c2d745894c8daf8af51ae.jpg?1329274269');
}
// data:image/jpeg;base64,ooxx
$mine_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($image);
$image_base64 = base64_encode($image);
$src = "data:{$mine_type};base64,{$image_base64}";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div><button onclick="location.href = 'edit.php'">編輯</button></div>
    <h1><?= $cname; ?> WWWWWeeeeee</h1>
    <img src="<?= $src; ?>">
    <a href="logout.php">登出</a>
</body>
</html>