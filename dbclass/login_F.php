<?php session_start(); ?>
<?php
if (isset($_COOKIE["token"])) {
    header("location: " . $_COOKIE["welcome"]);
}
?>
<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <title>Document</title>
</head>
<script>

</script>
<body>
    <form action="checkin.php" method="post">
        uid:<input type="text" id="uid" name="uid">&nbsp;<span id="show"></span><p></p>
        pwd:<input type="password" id="password" name="pwd"><p></p>
        <button id="register">登入</button>
    </form>
</body>

</html>