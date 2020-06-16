<?php

class Datum
{
    public function setS($s)
    {
        $this->s = $s;
    }
    public function echoS()
    {
        echo $this->s , "\n";
    }
    //
    private $s;    
}

//
$obj = new Datum();
$obj->setS('sting');
$obj->echoS();

//
var_dump($obj);

//
$obj2 = new Datum();
$obj2->setS('hoge');
var_dump($obj2);