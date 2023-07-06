<?php session_start(); ?>
<?php
    require_once('DB.php');
    require_once('user.php');
    /*
    session_destroy();
    setcookie("token", '', -1);
    setcookie("welcome", '', -1);

    DB::call('call logout(?)', [$token]);

    header("location: login_F.php");
    */
    $user = unserialize($_SESSION['user']);
    $user->redirect_logout();
?>