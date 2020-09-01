<?php
require_once('init.php');
require_once(BASEPATH . '/libs/TestModel.php');

//INSERT

/*
$model = new TestModel();
$model->i = 10;
$model->s = 'string';
var_dump($model);
*/
//SEELCT
$mobj = TestModel::find(i);
var_dump($mobj);

$mobj = TestModel::find(999);
var_dump($mobj);