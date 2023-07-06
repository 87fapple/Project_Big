<?php session_start(); ?>
<?php
require_once('DB.php');
require_once('user.php');

if (! $_COOKIE["token"] ) {
    header("location: login_F.php");
    die();
}

$user = unserialize($_SESSION['user']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
</head>
<script>
    function myFunction(){
        var x = document.getElementById("e_pwd");
        if (x.type === "password"){
            x.type = "text";
        }else {
            x.type = "password";
        }
    }

    function myComfine(){
        var text;
        if(confirm("確認修改")) {
            text = "oh yes";
        } else {
            return false;
        }
    }
</script>
<body>
    <h2>修改內容</h2>
    <form action="editUserInfo.php" method="post" enctype="multipart/form-data">
        姓名:<input type="text" name="e_cname" id="e_cname" value="<?= $user->cname ?>" required><p></p>
        密碼:<input type="password" name="e_pwd" id="e_pwd" value="<?= $user->pwd ?>">
        <input type="checkbox" id="ck" onclick="myFunction()"><label for="ck">顯示密碼</label><p></p>
        大頭照: <input type="file" name="file"><p></p>
        <input type="submit" value="確認修改" onclick="myComfine()">
    </form>
</body>
</html>