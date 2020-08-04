<?php
//
class Model
{

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function escape($value)
    {
        //配列がない場合の再度コール
        if(true === is_array($value))
        {
            foreach($value as $k => $v)
            {
                $value[$k] = $this->escape($v);
            }
            return $value;
        }
        //elseは後日
        //とりあえずざっくりと(英数アンスコ以外はだめです)
        $len = strlen($value);
        for($i = 0; $i < $len; ++$i)
        {
            //
            if( true === ctype_alnum($value[$i]))
            {
                continue;
            }
            if('_' === $value[$i])
            {
                continue;
            }
            throw new \Exception("識別子{$value} にはダメな文字が含まれてるねぇキミキミ");
        }
        return $value;

    }
    public function insert()
    {
        $dbh = DbHandle::get();

        //
        //識別子のエスケープやらなんやら
        $table_name = $this->escape($this::$table_name);
        $cols = $this->escape(array_keys($this->data));

        //
        $sql_cols = implode(', ', $cols);
        $holder = [];
        foreach($cols as $s)
        {
            $holder[] = ":{$s}";
        }
        $sql_holder = implode(', ', $holder);

        //
        $sql = "INSERT INTO {$table_name}({$sql_cols}) VALUES({$sql_holder});";
        $pre = $dbh->prepare($sql);
        var_dump($pre);

        //プレースホルダに値をバインド
        foreach($this->data as $k => $v)
        {
            //
            if(true === is_null($v))
            {
                $type = \PDO::PARAM_NULL;
            }else if( (true === is_int($v) ) || (true === is_float($v)) )
            {
                $type = \PDO::PARAM_INT;
            } else
            {
                $type = \PDO::PARAM_STR;
            }
            //
            $pre->bindValue(":{$k}", $v, $type);
        }
        //疾くSQL実行
        $r = $pre->execute();
        //var_dump($r);
        return($r);

        public static function find($value)
        {
            
        }
    }
/*
INSERT,
UPDATE,
SELECT (WEHRE , ID)
*/
private $data = [];
}