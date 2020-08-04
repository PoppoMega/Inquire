<?php

//初期
require_once('init.php');
require_once(BASEPATH . '/libs/TestModel.php');

$model = new TestModel();
$model->i = 10;
$model->s = 'yusaku';
var_dump($model);

$r = $model->insert();
var_dump($r);