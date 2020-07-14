<?php
ob_start();

//samesite cookie/
setcookie('test', mt_rand(0,999));
var_dump($_COOKIE);
ob_end_flush();