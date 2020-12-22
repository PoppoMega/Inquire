<?php

require_once('init_admin_auth.php');
require_once(BASEPATH . '/libs/InquiryModel.php');

//データ取得
$params = ['inquiry_id','reply_charge','reply_subject','reply_body'];
$data = [];
$error_message = [];
foreach($params as $p)
{
    if('' === ($data[$p] = strval($_POST[$p] ?? '')))
    {
        $error_message[] = "{$p}は必須です";
    }
}
//XXXエラーチェック
if([] !== $error_message)
{
    //
    var_dump($error_message);
    exit;
}



$model = InquiryModel::find($data['inquiry_id']);
//var_dump($model);
//エラーチェック(model)
if(null === $model)
{
    echo '迫真エラー部、クラックの裏技';
    exit;

}

//エラーチェック(未送信か)
if(null !== $model->reply_at)
{
    echo "迫真問い合わせ部、返信の裏技";
    exit;
}

//mail送信
//メール本体作成
$from = 'inquiry@example.com';
$message = (new Swift_Message($data['replay_subject']))
    ->setFrom($from)
    ->setTo($model->email);
    ->setBody($data['reply_body'])
    ;
var_dump($message);

//送信
/*
if(0 === $r)
{
    echo "迫真送信部、失敗の裏技";
    exit;
}
*/

//データ更新
foreach($params as $p)
{
    //pkは更新し)ないです
    if('inquiry_id' === $p)
    {
        continue;
    }
    //
    $model->$p = $data[$p];
}
//
$model->reply_at = data('Y-m-d H:i:s');
//$model-reply_at = (new DateTime()) ->format('Y-m-d H:i:s');→こっちでも

$r = $model->update();
if(false === $r)
{
    echo '迫真更新部、失敗の裏技';
    var_dump(DbHandle::get()->errorInfo());
    exit;
}

//詳細画面に移行
header('Location: inquiry_datail.php?inquiry_id=' . rawurldecode($model->inquiry_id));



