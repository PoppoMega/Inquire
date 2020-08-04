<?php
error_reporting(-1);
class Hoge
{
    public function __set($name, $value)
    {
        //
        $this->$data[$name] = $value;
        //var_dump($name, $value);
    }

    public $pub_i;
    private $pri_i;
}

//
$obj = new Hoge();
$obj->pub_i = 10;

$obj->i = 777;
//
$s = '\'--;';
//
var_dump($obj);
