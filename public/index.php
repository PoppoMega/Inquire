<?php

//初期処理読み込み
require_once('init.php');

//var_dump($twig);
echo $twig->render('front/inquiry.twig', []);