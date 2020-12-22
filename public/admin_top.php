<?php

require_once('init_admin_auth.php');
require_once(BASEPATH . '/libs/InquiryModel.php');

//検索データとsortデータ取得
$find_item_list = [
    'name',
    'from',
    'to',
];
$find_multiitem_list = [
    'reply_flg',
];
//
$find_items = [];//検索データ用
$find_params = [];//sortデータ用

//
foreach($find_item_list as $s)
{
    $find_items[$s] = strval($_GET[$s] ?? '');
    $find_params[] = "{$s}=" . rawurlencode($find_items[$s]);
}
foreach($find_multiitem_list as $s)
{
    $find_items[$s] = (array)($_GET[$s] ?? []);
    foreach($find_items[$s] as $k => $v)
    {   
        //$find_params[] = rawurlencode("{$s}[]") . '=' . rawurlencode($v);こっちのほうがまぁ汎用性が高い？
        $find_params[] = "{$s}%5B%5D" . rawurlencode($v);
    }
}

//sort情報の取得
$sort = strval($_GET['sort'] ?? '');

//ページング
$page = abs(intval($_GET['page'] ?? 0));

;
$ret = InquiryModel::getList($find_items, $sort, $page);
$context['inquiry_list'] = $ret['data'];
$context['count'] = $ret['count'];
//お問い合わせ一覧取得
$context = [
    'find_items' => $find_items,
    'find_param_string' => implode('&', $find_params),
    'inquiry_list' => $ret['data'],
    'count' => $ret['count'],
    'max_page' => ceil($ret['count'] /20) - 1,
];

//出力楊設定
$template_file_name = 'admin/top.twig';

//終了処理読み込み
require_once('fin.php');