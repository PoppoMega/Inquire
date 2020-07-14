<?php

//初期処理読み込み
require_once('init.php');
//入力受け取り
$param = ['name', 'email', 'body'];
$data = [];
foreach($param as $p)
{
    $data[$p] = strval($_POST[$p] ?? '');
}
//var_dump($data);
//validate
$error_messages = [];
//必須チェック
if('' === $data['email'])
{
    $error_messages[] = 'emailアドレスは必須だゾ☆<br>';
}

if('' === $data['body'])
{
    $error_messages[] = '問い合わせ内容がないゾ。なんのためにこのページに来たんだ？☆<br>';
}
//email形式チェック
if(false === filter_var($data['email'], FILTER_VALIDATE_EMAIL))
{
    $error_messages[] = '正しいemailアドレスを入れろ<br>';
}
//var_dump($error_messages);
//エラー確認
if([] !== $error_messages)
{
    //
    echo "入力にミスがあるぞあく修正しろ<br>";
    foreach($error_messages as $s)
    {
        echo $s;
    }
    exit;
}

//XXX validate〇だったら

//テンプレートに渡す
$context = [];
$context['data'] = $data;
//セッションにデータ突っ込む
$_SESSION['inquiry_data'] = $data;

//出力要設定
$template_file_name = 'front/inquiry_comfirm.twig';


//var_dump($twig);
require_once('fin.php');