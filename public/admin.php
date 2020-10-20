<?php

//初期
require_once('init.php');

//セッションにフラッシュデータがあったらとる
$context  = $_SESSION['admin']['flash'] ?? [];
unset($_SESSION['admin']['flash']);
//var_dump($context);
//
$template_file_name = 'admin/admin.twig';


//終了処理
require_once('fin.php');
