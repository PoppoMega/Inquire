<?php

class StaticClass
{
    static public function setData($v)
    {
        static::$data = $v;
    }
    static public function getData()
    {
        return static::$data;
    }

    private static $data;
}

StaticClass::setData('string');
echo StaticClass::getData() , "\n";