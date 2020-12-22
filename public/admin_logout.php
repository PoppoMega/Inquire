<?php
//初期処理
require_once('init.php');

//認可チェック
unset($_SESSION['admin']));

header('Location: admin.php');
