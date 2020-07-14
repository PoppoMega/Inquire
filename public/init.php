<?php
ob_start();

define('BASEPATH', realpath(__DIR__ . '/..'));
/*
var_dump(__DIR__);
var_dump(__DIR__ . '/..');
var_dump( realpath(__DIR__ . '/..') );
exit;
*/
// vendorを使うので
require_once(BASEPATH . '/vendor/autoload.php');
//Config読み込み
require_once(BASEPATH . '/libs/Config.php');
//
require_once(BASEPATH . '/libs/DbHandle.php');
// Twigインスタンスを生成
$path = __DIR__ . '/../templates';
$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader($path));
