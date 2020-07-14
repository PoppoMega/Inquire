<?php
//初期処理読み込み
require_once('init.php');

//テーブルに書き込む
if(true === isset($_SESSION['inquiry_data'])){
    $dbh = DbHandle::get();

    //プリペアードステートメント作成
    $sql = 'INSERT INTO inquiry(name, email, body, created_at) VALUES(:name, :email, :body, :created_at);';

    $pre = $dbh->prepare($sql);
    //var_dump($pre);
    //プレースホルダに値をバインド
    $pre->bindValue(':name', $_SESSION['inquiry_data']['name']);
    $pre->bindValue(':email', $_SESSION['inquiry_data']['email']);
    $pre->bindValue(':body', $_SESSION['inquiry_data']['body']);
    $pre->bindValue(':created_at', date('Y-m-d H:i:s'));

    //SQL実行
    $r = $pre->execute();
    var_dump($r);

    //sessionの情報を削除
    unset($_SESSION['inquiry_data']);
}

//完了画面へ移す
header('Location: ./inquiry_fin_print.php');
