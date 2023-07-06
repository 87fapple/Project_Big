<?php

if($_REQUEST['get'] == 1){
    setcookie('name','jjan', time() + 30);
    echo 'done';
}else {
    echo $_COOKIE['name'];
}