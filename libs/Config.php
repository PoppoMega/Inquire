<?php
class Config
{
    static public function get($name, $dafault = null)
    {
        if(null === static::$data)
        {
           //設定ファイルを読み込む
           static::read(); 
        }
        //
        return static::$data[$name] ?? $default;
    }

    static public function read()
    {
        //設定ファイル読み込み
        static::$data = require_once(BASEPATH . '/Environmental_dependence.conf');
        //var_dump(static::$data);
    }

    private static $data = null;
}

