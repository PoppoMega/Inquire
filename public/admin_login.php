<?php

//初期処理
require_once('init.php');
require_once(BASEPATH . '/libs/AdminAuthentication.php');

var_dump($_POST);
//formから情報を取得
$id = strval($_POST['id']) ?? '';
$pass = strval($_POST['pw']) ?? '';


//情報を取得
if(null === AdminAuthentication::login($id,$pass)){
    //
    $_SESSION['admin']['flash']['authentication_error'] = true;
    $_SESSION['admin']['flash']['id'] = $id;

   
    //入力画面に戻す
    //echo 'ng';
    header('Location: ./admin.php');
}

//PASSチェック
echo 'ok';
