<?php

//require_once('./init.php');
//init.phpをincludeしてからの使用を想定
class DbHandle
{
    static public function get() : \PDO
    {   
        static $dbh = null;
        if($dbh === null)
        {
            $user = Config::get('db_user');
            $pass = Config::get('db_pass');
            $host = Config::get('db_host');
            $dbname = Config::get('db_dbname');
            $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
            //
            $option = [
                \PDO::ATTR_EMULATE_PREPARES => false, //静的プレースホルダにする
                \PDO::MYSQL_ATTR_MULTI_STATEMENTS => false, //複文を禁止
            ];
            try
            {
                $dbh = new \PDO($dsn, $user, $pass, $option);
            }catch(\PDOException $e)
            {
                echo $e->getMessage();
                exit;
            }
        }
        return $dbh;
    }
}

$dbh = DbHandle::get();//PDo
//var_dump($dbh);