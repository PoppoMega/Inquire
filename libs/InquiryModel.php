<?php
require_once(BASEPATH . '/libs/model.php');

class InquiryModel extends Model
{
    //
    protected static $table_name = 'inquiry';
    protected static $pk_name = 'inquiry_id';

    //一覧取得
    public static function getList(array $find_items, string $sort, int $page)
    {
        $dbh = DbHandle::get();

        //プリペアード作成
        $sql = 'FROM inquiry';
        $where = [];
        $binds = [];
        $created_at_from_to = 0;
        //名前曖昧検索
        if('' !== $find_items['name'])
        {
            $where = ' name LIKE :name ';
            $binds[':name'] = str_replace(['%','_'], ['\\%','\\_'], $find_items['name']);
        }

        /*問い合わせ日時*/
        if('' !== $find_items['from'])
        {
            $binds[':from'] = date('Y-m-d H:i:s', strtotime("{$find_items['from']} 00:00:00"));
            $created_at_from_to += 1;
        }
        if('' !== $find_items['to'])
        {

            $binds[':to'] = date('Y-m-d H:i:s', strtotime("{$find_items['to']} 23:59:59"));
            $created_at_from_to += 2;
        }
        if(1 === $created_at_from_to)
        {
            $where[] = 'created_at >= :from';
        }else if(2 === $created_at_from_to)
        {
            $where[] = 'created_at <= to';
        }else if(3 === $created_at_from_to)
        {
            $where[] = 'created_at BETWEEN :from AND :to';
        }
        /* ビット演算やらなんやら */
        //bit演算で未返信と返信済み
        $reply_flg = 0;
        if(true === in_array('0', $find_items['reply_flg'], true))
        {
            
            $reply_flg += 1;
        }
        if(true === in_array('0', $find_items['reply_flg'], true))
        {
            echo "返信済みチェック";
            $reply_flg += 2;
        }
        //
        if(1 === $reply_flg)
        {
            $where[] = 'reply_at is null';
        }
        if(2 === $reply_flg)
        {
            $where[] = 'reply_at is not null';
        }

        /*ステータス*/
        //$sql .= ' ORDER BY inquiry_id DESC LIMIT 20 OFFSET :;';
        
        //where合成
        if([] !== $where)
        {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        //count*取得
        $sql_count = 'SELECT count(*) as cnt ' . $sql . ';';
        $pre = $dbh->prepare($sql_count);
        //値バインド
        foreach($binds as $k => $v)
        {
            $pre->bindValue($k, $v);
        }
        //SQL実行
        $r = $pre->execute();
        $count = $pre->fetch(\PDO::FETCH_ASSOC)['cnt'];
//var_dump($count);exit;
        //sortの決定
        //第一種ホワイトリスト使用
        $sort_white_list = [
            'created_at' => 'created_at',
            'created_at_desc' => 'created_at_desc',
            'name' => 'name',
            'name_desc' => 'name_desc',
        ];
        $sort_e = $sort_white_list[$sort] ?? 'inquiry_id DESC';
        //
        $sql_list = 'SELECT * ' . $sql . " ORDER BY {$sort_e} LIMIT 20 OFFSET :offset ";
        $pre = $dbh->prepare($sql_list);


        //値のバインド
        foreach($binds as $k => $v)
        {
            $pre->bindValue($k, $v);
        }
        //offsetバインド
        $pre->bindValue(':offset', 20 * $page);
        //SQL実行
        $r = $pre->execute();
        //
        $ret = [
            'data' => $pre->fatchAll(\PDO::FETCH_ASSOC),
            'count' => $count,
        ];

        return $ret;        
    }
}