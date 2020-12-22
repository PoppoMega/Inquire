<?php

// vendorを使うので
require_once(__DIR__ . '/../vendor/autoload.php');


$from = 'root@dev2.m-fr.net';
$to = 'masinnkurahuto@yahoo.co.jp';//わしのアドレス
$subject = 'testsubject';
$message = 'unchi please';

//$r = mail($to,$subject,$message);
//var_dump($r);

$smtp = new Swift_SmtpTransport('localhost', 25);
//var_dump($smtp);

//メール作成
$message = (new Swift_Message($subject))
    ->setFrom($from)
    ->setTo($to)
    ->setBody($message)
    ;

$r = (new Swift_Mailer($smtp)) ->send($message);
var_dump($r);