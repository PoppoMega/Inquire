<?php
class Hoge
{
    //
    public function t()
    {
        $i = 0;
        static $j = 0;
        
        echo "{$i} / {$j}\n";
        $i++;
        $j++;
        echo "{$i} / {$j}\n";
        $i++;
        $j++;
        echo "{$i} / {$j}\n";

    }
}

//
$obj = new Hoge();
$obj->t();
echo "\n";
$obj->t();