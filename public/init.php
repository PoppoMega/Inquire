<?php
define('BASEPATH', realpath(__DIR__ . '/..'));
/*
var_dump(__DIR__);
var_dump(__DIR__ . '/..');
var_dump( realpath(__DIR__ . '/..') );
exit;
*/
// vendorを使うので
require_once(BASEPATH . '/vendor/autoload.php');

// Twigインスタンスを生成
$path = __DIR__ . '/../templates';
$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader($path));
