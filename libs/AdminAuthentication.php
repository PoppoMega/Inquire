<?php
require_once(BASEPATH . '/libs/AdminAccountsModel.php');

class AdminAuthentication
{
    //
    protected const LOCK_NUM = 5; //ロックされる回数
    protected const LOCK_TIME = 30;
    public static function login($id,$pass)
    {
        //簡単にヴァり
        if(( '' === $id) || ('' === $pass))
        {
            //突っ返す
            return null;
        }

        $admin_account_obj = AdminAccountsModel::find($id);
        if(null === $admin_account_obj)
        {
            //NG
            return null;
        }
        //XXX
        /*looc時間確認 */
        if(null !== $admin_account_obj->lock_datetime)
        {
            //locktimeが今よりも先だったら
            if(time() < strtotime($admin_account_obj->lock_datetime))
            {
                //管理者へメール
                return null;
            }
            //
            $admin_account_obj->lock_date;
            //
        }
        
        //passwordチェック
        if(false === password_verify($pass, $admin_account_obj->password))
        {
            //NG
            $admin_account_obj->error_num + 1;
            $admin_account_obj->update();

            //
            if($admin_account_obj->error_num >= self::LOCK_NUM)
            {
                //
                $admin_account_obj->lock_datetime = date('Y-m-d H:i:s', time() + self::LOCK_TIME);
                //
                $admin_account_obj->error_num = 0;
            }

            //XXXeroornumをインクリメント

            //var_dump($admin_account_obj);exit;
            return null;

        }
        //
        //XXX認証OKでエラーをクリア
        if(0 != $admin_account_obj->error_num)
        {
            $admin_account_obj->error_num = 0;
            $admin_account_obj->update();
        }

        return $admin_account_obj;
        
    }    
}