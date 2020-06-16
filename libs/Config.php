<?php
class Config
{
    static public function get($name)
    {
        return static::$data[$name] ?? null;
    }

    static public function read()
    {
        //設定ファイル読み込み
        static::$data = require_once(BASEPATH . '/Environmental_dependence_develop.conf');
        //var_dump(static::$data);
    }

    private static $data;
}

//test
Config::read();
echo Config::get('db_user') , '\n';