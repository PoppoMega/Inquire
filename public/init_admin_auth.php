<?php

// 初期処理の読み込み
require_once('init.php');

// 認可チェック
if (false === isset($_SESSION['admin']['auth'])) {
    header('Location: admin.php');
    exit;
}