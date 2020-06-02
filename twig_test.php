<?php   // twig_test.php

 

// vendorを使うので
require_once __DIR__ . '/vendor/autoload.php';

 

// Twigインスタンスを生成
$path = __DIR__ . '/templates';
$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader($path));

 

var_dump($twig);