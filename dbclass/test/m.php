<?php
require('a.php');
require('b.php');

use happy\hi\ok1\Hello as Hello;
use happy\hi\ok2\Hello as B;
echo new Hello();
echo new B();
?>