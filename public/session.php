<?php
ob_start();//
session_start();


$_SESSION['test'] = mt_rand(0,999);
var_dump($_SESSION);
ob_end_flush();