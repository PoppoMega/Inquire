<?php
//
class Model
{

    public function __set($name, $value)
    {
        //primarykeyならだめです
        if((true === $pk_deter_flg) && $name === static::$pk_name)
        {
            throw new \Exception('主キーは変更できません');
        }
        //
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        //
        if(false === array_key_exists($name, $this->data))
        {
            throw new \Exception("{$name}は無いです");
        }
        return $this->data[$name];
    }

    //
    public static function escape($value)
    {
        //配列がない場合の再度コール
        if(true === is_array($value))
        {
            foreach($value as $k => $v)
            {
                $value[$k] = static::escape($v);
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

    /*INSERT */
    public function insert()
    {
        $dbh = DbHandle::get();

        //
        //識別子のエスケープやらなんやら
        $table_name = $this::escape($this::$table_name);
        $cols = $this::escape(array_keys($this->data));

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
        
        //PK更新の抑止
        if(true === $r)
        {
            $this->pk_deter_flg = true;
        }
        return($r);


    }

    /* FIND */
    public static function find($value)
    {
        //
        $dbh = DbHandle::get();
        //プリペアードステートメント作成
        $table_name = static::escape(static::$table_name);
        $pk_name = static::escape(static::$pk_name);
        $sql = "SELECT * FROM {$table_name} WHERE {$pk_name} = {$pk_name}";
        $pre = $dbh->prepare($sql);

        //
        if( (true === is_int($value) ) || (true === is_float($value)) )
        {
            $type = \PDO::PARAM_INT;
        } else
        {
            $type = \PDO::PARAM_STR;
        }
        //
        $pre->bindValue(":{$pk_name}", $value, $type);

        //SQL実行
        $r = $pre->execute();

        //データ取得
        $data = $pre->fetch(\PDO::FETCH_ASSOC);

        if(false === $data)
        {
            return null;
        }
        //var_dump($data);

        //
        $robj = new static();
        $robj->data = $data;
        /*
        foreach($data as $k =>$v)
        {
            $obj->$k = $v;
        }
        */

        //PK更新の抑止
        $robj->pk_deter_flg = true;

        //
        return $robj;
    }

    /* UPDATE */
    public function update()
    {
        //更新するブツ取得
        //変更のないデータもアップ
        $data = $this->data;
        unset($data[static::$pk_name]);
        //var_dump($data);
        
        //ｐｋ情報取得
        $pk = $this->{static::$pk_name};
        //var_dump(static::$pk_name,$pk);

        //
        $dbh = Dbhandle::get();
        //SQ組み立て
        $table_name = $this::escape($this::$table_name);
        $cols = $this::escape(array_keys($data));
        $pk_col = $this::escape(static::$pk_name);

        //
        $set_array = [];
        foreach($cols as $s)
        {
            $set_array[] = "{$s} = :{$s}";
        }
        $set_value = implode(', ', $set_array);
    $sql = "UPDATE {$table_name} SET {$set_value} WHERE {$pk_col} =:{$pk_col};";
        //var_dump($table_name,$cols,$pk_col);exit;
        $pre = $dbh->prepare($sql);

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
        //実行

        var_dump($sql);
        exit;
    }
/*
INSERT,
UPDATE,
SELECT (WEHRE , ID)
*/
private $data = [];
private $pk_deter_flg = false;
}